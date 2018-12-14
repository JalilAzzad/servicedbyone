<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Seo;


View::composer('*', function ($view) {
    //
    $baseUrl=url('/');
    $currentUrl=url()->current();
    $currentUrl=str_replace($baseUrl,"",$currentUrl); 
    $seo = Seo::where('url', '=', 'https://servicedbyone.com'.$currentUrl)->first();

    $view->with('seo',$seo);

});

Auth::routes(['verify' => true]);
Route::get('/auth/set-password', 'User\PasswordController@get')->name('auth.setPassword.get');
Route::post('/auth/set-password', 'Auth\PasswordController@post')->name('auth.setPassword.post');

Route::get('social/login/{provider}', 'Auth\SocialController@login')->name('social.login');
Route::get('social/callback/{provider}', 'Auth\SocialController@callback')->name('social.callback');

Route::get('/dashboard', 'User\HomeController@dashboard')->name('user.dashboard')->middleware('auth');
// User referral table
Route::get('/referral', 'User\HomeController@referral');

Route::get('/settings', 'User\SettingsController@index')->name('user.settings');
Route::post('/settings/updateInfo', 'User\SettingsController@updateInfo')->name('user.settings.updateInfo');
Route::post('/settings/updatePassword', 'User\SettingsController@updatePassword')->name('user.settings.updatePassword');

Route::get('/service-request/{id}', 'User\ServiceRequestController@show')->name('user.service-requests.show');
Route::get('/service-request/{hash}/invoice', 'User\ServiceRequestController@invoice')->name('user.service-requests.invoice');
Route::post('/service-request/{id}/invoice', 'User\ServiceRequestController@charge')->name('user.service-requests.charge');
Route::post('/service-request/{id}/invoice/json', 'User\ServiceRequestController@chargeJson')->name('user.service-requests.chargeJson');


// Admin Home Routes
Route::get('/admin', 'Admin\HomeController@dashboard')->name('admin.dashboard');
Route::resource('/admin/users', 'Admin\UserController');
Route::resource('/admin/seos', 'Admin\SeoController');

// Home Routes
Route::get('/', 'Home\HomeController@index')->name('home');
Route::get('/contact', 'Home\HomeController@contact')->name('contact');
Route::get('/about', 'Home\HomeController@about')->name('about');
Route::get('/careers', 'Home\HomeController@careers')->name('careers');
Route::get('/press', 'Home\HomeController@press')->name('press');

//Our Services
Route::get('/our-services', 'ServiceCategoryController@showOurServices');

//Cookie referrer
Route::get('/r/{slug}','Home\HomeController@cookieReferrer');

Route::get('/support/guides', 'Home\SupportController@guides')->name('support.guides');
Route::get('/support/how-it-works', 'Home\SupportController@howItWorks')->name('support.howItWorks');
Route::get('/support/safety', 'Home\SupportController@safetyAndInsurance')->name('support.safetyAndInsurance');
Route::get('/support/testimonials', 'Home\SupportController@testimonialsAndReviews')->name('support.testimonialsAndReviews');

Route::get('/customer/how-it-works', 'Home\CustomerController@howItWorks')->name('customer.howItWorks');
Route::get('/customer/safety', 'Home\CustomerController@safety')->name('customer.safety');
Route::get('/customer/near-me', 'Home\CustomerController@nearMe')->name('customer.nearMe');
Route::get('/customer/prices', 'Home\CustomerController@prices')->name('customer.prices');
Route::get('/customer/how-to', 'Home\CustomerController@howTo')->name('customer.howTo');

Route::get('/worker/how-it-works', 'Home\WorkerController@howItWorks')->name('worker.howItWorks');
Route::get('/worker/safety', 'Home\WorkerController@safety')->name('worker.safety');

Route::get("/legal/privacy-policy", "Home\LegalController@privacyPolicy")->name('legal.privacyPolicy');
Route::get("legal/terms-of-use", "Home\LegalController@termsOfUse")->name("legal.termsOfUse");

// Admin showInvoice
Route::get('/admin/service-requests/showInvoice/{id}','Admin\ServiceRequestController@showInvoice');

// Admin changeRefferal
Route::get('/admin/service-requests/changeRefferal/{id}/{request_id}','Admin\ServiceRequestInvoiceController@changeRefferal');

// Json Service related data routes
Route::get('/admin/services/states', 'Admin\ServiceController@states');
Route::get('/admin/services/cities', 'Admin\ServiceController@cities');
Route::get('/admin/services/areas', 'Admin\ServiceController@areas');
Route::get('/admin/services/categories', 'Admin\ServiceController@categories');
Route::get('/admin/services/questions', 'Admin\ServiceController@questions');

// Admin Service Related Routes
Route::post('/admin/service-requests/{id}/quote', 'Admin\ServiceRequestController@quote')->name('service-requests.quote.update');
Route::delete('/admin/service-questions/{question_id}/choices/{choice_id}', 'Admin\ServiceQuestionController@destroyChoice')->name('service-questions.choices.destroy');
Route::resources([
    '/admin/service-requests' => 'Admin\ServiceRequestController',
    '/admin/service-requests.invoice' => 'Admin\ServiceRequestInvoiceController',
    '/admin/service-questions' => 'Admin\ServiceQuestionController',
    '/admin/service-categories' => 'Admin\ServiceCategoryController',
    '/admin/services' => 'Admin\ServiceController',
]);

// Admin Partners
Route::resources(['/admin/partners' => 'Admin\PartnerController']);

// Show Partner
Route::get('/partner/{id}', 'PartnerController@showPartner');

// Service Routes
Route::get('/services/{id}', 'ServiceController@show');
Route::post('/services/{id}', 'ServiceController@serviceRequest');
Route::get('/service-categories/{id}', 'ServiceCategoryController@show');
Route::get('/{state_code}', 'LocationController@state');
Route::get('/{state_code}/{city_id}', 'LocationController@city');
Route::get('/{state_code}/{city_slug}/{service_slug}', 'LocationController@service');




