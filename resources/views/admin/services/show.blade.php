@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Service#{{$service->id}}</h2>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$service->id}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Name') }}</th>
                <td>{{$service->name}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Slug') }}</th>
                <td>{{$service->slug}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Description') }}</th>
                <td>{{$service->description}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Categories') }}</th>
                <td>
                    @foreach($service->categories as $c)
                        {{$c->id . ' | ' . $c->name}} <br/>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('Location Type') }}</th>
                <td>{{$service->location_type}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('State Locations') }}</th>
                <td>
                    @foreach($service->states as $l)
                        {{$l->state . ' | ' . $l->state_code}} <br/>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('City Locations') }}</th>
                <td>
                    @foreach($service->cities as $l)
                        {{$l->city . ' | ' . $l->state_code}} <br/>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('City Area Locations') }}</th>
                <td>
                    @foreach($service->areas as $l)
                        {{ $l->county . ' | ' . sprintf("%05d", $l->zip) . ' | ' . $l->city->city . ' | ' . $l->city->state_code }} <br/>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('Questions') }}</th>
                <td>
                    @foreach($service->questions as $q)
                        {{$q->id . ' | ' . $q->name . ' | ' . $q->question}} <br/>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th scope="row">{{ __('Featured Image') }}</th>
                <td><img class="img-thumbnail" src="{{is_null($service->featured_image) ? asset('/images/service-default.png') : asset(str_replace("public","storage", $service->featured_image)) }}" alt="Service Featured Image"></td>
            </tr>
            <tr>
                <th scope="row">{{ __('Actions') }}</th>
                <td>
                    <a class="btn btn-secondary" href="{{route('services.edit', $service->id)}}">Edit</a>
                    @include('admin.layouts.deleteform', ['action' => route('services.destroy', $service->id), 'id' => $service->id])
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="{{url()->previous() == url()->current() ? '/admin/services' :url()->previous()}}">Back</a>
    </div>
@endsection
