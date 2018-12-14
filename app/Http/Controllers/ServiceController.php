<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityArea;
use App\Models\Service;
use App\Models\ServiceQuestion;
use App\Models\ServiceQuestionValidationRule;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestAnswer;
use App\Models\ServiceRequestAnswerBoolean;
use App\Models\ServiceRequestAnswerChoice;
use App\Models\ServiceRequestAnswerDate;
use App\Models\ServiceRequestAnswerDateTime;
use App\Models\ServiceRequestAnswerFile;
use App\Models\ServiceRequestAnswerText;
use App\Models\ServiceRequestAnswerTextMultiline;
use App\Models\ServiceRequestAnswerTime;
use App\Models\State;
use App\Models\User;
use App\Rules\Phone;
use App\Rules\ServiceRequestLocation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($service_slug)
    {
        $service = Service::where('slug', $service_slug)->with('states', 'questions')->firstOrFail();
        if(!session('visitor.zip')){
            session(['visitor.zip'=>'10550']);
        }

        $location = CityArea::where('zip', session('visitor.zip'))->with('city', 'city.state')->first();
        if(!$location) {
            session(['visitor.zip'=>'10550']);
            $location = CityArea::where('zip', session('visitor.zip'))->with('city', 'city.state')->first();
        }
        $city = $location->city;
        return view('services.show', ['city' => $city, 'service' => $service, 'location' => $location]);
    }

    /**
     * Store request data.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceRequest(Request $request, $service_id)
    {
        $service = Service::where('id', (int) $service_id)->with('questions')->firstOrFail();
        $validatedData = $this->validateAnswers($service, $request);

        $serviceRequest = ServiceRequest::create([
            'service_id' => $service->id,
            'user_id' => auth()->id(),
            'city_area_id' => $validatedData['city_id']
        ]);

        $user = new User();

        foreach ($service->questions as $q)
        {
            if(isset($validatedData['answer-'.$q->id]))
            {
                if($q->is_only_for_authenticated) {
                    if (!auth()->check())
                        continue;
                }
                if($q->is_only_for_guest) {
                    if (!auth()->guest())
                        continue;
                }
                $answers = array();
                if($q->type == ServiceQuestion::TYPE_BOOLEAN)
                    $answers[] = ServiceRequestAnswerBoolean::create(['answer' => $validatedData['answer-'.$q->id]]);
                else if($q->type == ServiceQuestion::TYPE_TEXT)
                {
                    if($q->name == 'guest.name')
                        $user->name = $validatedData['answer-'.$q->id];
                    else if($q->name == 'guest.email')
                        $user->email = $validatedData['answer-'.$q->id];
                    else if($q->name == 'guest.phone')
                        $user->phone = $validatedData['answer-'.$q->id];
                    else
                        $answers[] = ServiceRequestAnswerText::create(['answer' => $validatedData['answer-'.$q->id]]);
                } else if($q->type == ServiceQuestion::TYPE_TEXT_MULTILINE)
                    $answers[] = ServiceRequestAnswerTextMultiline::create(['answer' => $validatedData['answer-'.$q->id]]);
                else if($q->type == ServiceQuestion::TYPE_SELECT)
                    $answers[] = ServiceRequestAnswerChoice::create(['choice_id' => (int) $validatedData['answer-'.$q->id]]);
                else if($q->type == ServiceQuestion::TYPE_SELECT_MULTIPLE)
                {
                    foreach ($validatedData['answer-'.$q->id] as $vd)
                        $answers[] = ServiceRequestAnswerChoice::create(['choice_id' => $vd]);
                }
                else if($q->type == ServiceQuestion::TYPE_TIME)
                    $answers[] = ServiceRequestAnswerTime::create(['answer' => $validatedData['answer-'.$q->id]]);
                else if($q->type == ServiceQuestion::TYPE_DATE)
                    $answers[] = ServiceRequestAnswerDate::create(['answer' => $validatedData['answer-'.$q->id]]);
                else if($q->type == ServiceQuestion::TYPE_DATE_TIME)
                    $answers[] = ServiceRequestAnswerDateTime::create(['answer' => $validatedData['answer-'.$q->id]]);
                else if($q->type == ServiceQuestion::TYPE_FILE)
                {
                    if(isset($validatedData['answer-'.$q->id]))
                    {
                        $path = $validatedData['answer-'.$q->id]->store('public/service-requests/' . $serviceRequest->id);
                        $answers[] = ServiceRequestAnswerFile::create(['file_path' => $path]);
                    }
                }
                else if($q->type == ServiceQuestion::TYPE_FILE_MULTIPLE)
                {
                    foreach ($validatedData['answer-'.$q->id] as $vd)
                    {
                        if(isset($vd))
                        {
                            $path = $vd->store('public/service-requests/' . $serviceRequest->id);
                            $answers[] = ServiceRequestAnswerFile::create(['file_path' => $path]);
                        }
                    }
                }

                foreach($answers as $answer){
                    $serviceRequestAnswer = ServiceRequestAnswer::create([
                        'request_id' => $serviceRequest->id,
                        'question_id' => $q->id,
                        'answer_id' => $answer->id,
                        'answer_type' => get_class($answer)
                    ]);
                }
            }
        }

        if(auth()->guest())
            $this->registerAndLoginGuestUser($user, $serviceRequest);

        return redirect()->back()->with('status', 'Your Request have been submitted successfully!!!');
    }

    private function validateAnswers(Service $service, Request $request)
    {
        $rules = array('city_id' => [
            'bail',
            'required',
            'integer',
            'exists:city_areas,zip',
            new ServiceRequestLocation($service->id)
        ]);
        foreach ($service->questions as $q)
        {
            $rules['answer-'.$q->id] = '';
            foreach ($q->rules as $rule)
            {
                if($rule->rule == ServiceQuestionValidationRule::AUTH_REQUIRED) {
                    if (!auth()->check()) {
                        $rules['answer-'.$q->id] = '';
                        continue 2;
                    }
                }
                if($rule->rule == ServiceQuestionValidationRule::AUTH_GUEST) {
                    if (!auth()->guest()) {
                        $rules['answer-'.$q->id] = '';
                        continue 2;
                    }
                }

                if($rule->rule == ServiceQuestionValidationRule::REQUIRED)
                    $rules['answer-'.$q->id] .= 'required|';
            }

            if($q->type == ServiceQuestion::TYPE_BOOLEAN)
                $rules['answer-'.$q->id] .= 'boolean';
            else if($q->type == ServiceQuestion::TYPE_TEXT) {
                if($q->name == 'guest.email')
                    $rules['answer-'.$q->id] .= 'email|unique:users,email';
                else if($q->name == 'guest.email')
                    $rules['answer-'.$q->id] .= [new Phone()];
                else
                    $rules['answer-'.$q->id] .= 'string|max:255';
            }
            else if($q->type == ServiceQuestion::TYPE_TEXT_MULTILINE)
                $rules['answer-'.$q->id] .= 'string|max:1000';
            else if($q->type == ServiceQuestion::TYPE_SELECT)
                $rules['answer-'.$q->id] .= 'integer|exists:service_question_choices,id';
            else if($q->type == ServiceQuestion::TYPE_SELECT_MULTIPLE){
                $rules['answer-'.$q->id] .= 'array';
                $rules['answer-'.$q->id.'.*'] = 'integer|exists:service_question_choices,id';
            }
            else if($q->type == ServiceQuestion::TYPE_TIME)
                $rules['answer-'.$q->id] .= 'date_format:"H:i"';
            else if($q->type == ServiceQuestion::TYPE_DATE)
                $rules['answer-'.$q->id] .= 'date';
            else if($q->type == ServiceQuestion::TYPE_DATE_TIME)
                $rules['answer-'.$q->id] .= 'date_format:"Y-m-d\TH:i"'; // 2018-01-01T01:01
            else if($q->type == ServiceQuestion::TYPE_FILE)
                $rules['answer-'.$q->id] .= 'image|max:15000';
            else if($q->type == ServiceQuestion::TYPE_FILE_MULTIPLE){
                $rules['answer-'.$q->id] .= 'array|max:10';
                $rules['answer-'.$q->id.'.*'] = 'image|max:15000';
            }
        }

        return $request->validate($rules);
    }

    private function registerAndLoginGuestUser(User $user, ServiceRequest $serviceRequest)
    {
        $user->save();
        $serviceRequest->user_id = $user->id;
        $serviceRequest->save();

        $user->syncRoles([User::USER]);
        auth()->loginUsingId($user->id);
        $user->sendEmailVerificationNotification();

        return true;
    }
}
