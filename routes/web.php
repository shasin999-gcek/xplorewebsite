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

use Illuminate\Support\Facades\Cookie;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::domain('proshow.xplore19.in')->group(function () {
    Route::get('/', 'EventController@showProgBrothers');
});

Auth::routes(['verify' => true]);

// admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('events', 'EventController');
    Route::resource('workshops', 'WorkshopController');
    Route::resource('banners', 'BannerController');
    Route::resource('offline-regs', 'OfflineRegistrationController');

    Route::get('event-registrations', 'EventRegistrationController@index')->name('event_regs.index');
    Route::get('workshop-registrations', 'WorkshopRegistrationController@index')->name('workshop_regs.index');
    Route::get('paytm-payments', 'PaymentController@paytm')->name('payments.paytm');
    Route::get('instamojo-payments', 'PaymentController@instamojo')->name('payments.instamojo');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('auth')->name('logs');

    Route::post('events/change-regstat/{event}', 'EventController@toggleRegistration');
    Route::post('workshops/change-regstat/{workshop}', 'WorkshopController@toggleRegistration');

    Route::get('reports', 'ReportController@showForm')->name('report.show');
    Route::get('reports/download', 'ReportController@generateReport')->name('report.download');
    
    // facebook sharing
    // Route::post('events/share/{event}', 'EventController@share_on_facebook')->name('share_on_fb');
});


Route::get('/user/profile', 'HomeController@index')->name('home');


Route::get('/events/{category}/', 'EventController@getEventsByCategory')->name('events');
Route::get('/workshops/{category}/', 'WorkshopController@getWorkshopsByCategory')->name('workshops');


Route::get('/events/{category}/{slug}', 'EventController@show')->name('display_event');
Route::get('/workshops/{category}/{slug}', 'WorkshopController@show')->name('display_workshop');


Route::get('/', 'Home@index');
Route::get('/about', 'Home@about');
Route::get('/contact', 'Home@contact');
Route::get('/technical', 'Home@technical');
Route::get('/cultural', 'Home@cultural');
Route::get('/management', 'Home@management');
Route::get('/sponsors', 'Home@sponsors');


// Registrations
Route::group(['middleware' => 'no-cache', 'as' => 'event.'], function () {
  //  Route::post('/event/register', 'EventRegistrationController@store')->name('register');
    Route::post('/event/register-payu', 'EventRegistrationController@storePayu')->name('register-payu');
    Route::post('/event/register-insta', 'EventRegistrationController@storeInsta')->name('register-insta');
 //   Route::post('/event/payment-callback', 'EventRegistrationController@paytmCallback')->name('payment.callback');
    Route::post('/event/payu-callback', 'EventRegistrationController@payuCallback')->name('payu.callback');
    Route::get('/event/insta-callback', 'EventRegistrationController@instaCallback')->name('insta.callback');
}); 

Route::group(['middleware' => 'no-cache', 'as' => 'workshop.'], function () {
    Route::post('/workshop/register', 'WorkshopRegistrationController@store')->name('register');
    Route::post('/workshop/payment-callback', 'WorkshopRegistrationController@paytmCallback')->name('payment.callback');
    Route::post('/workshop/register-insta', 'WorkshopRegistrationController@storeInsta')->name('register-insta');
    Route::get('/workshop/insta-callback', 'WorkshopRegistrationController@instaCallback')->name('insta.callback');
}); 



# Status Route
Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'PaymentController@status']);


Route::get('/event/get-ticket/{orderId}', 'GenerateInvoicePDF@generateEventTicket')->name('event.ticket');
Route::get('/workshop/get-ticket/{orderId}', 'GenerateInvoicePDF@generateWorkshopTicket')->name('workshop.ticket');

Route::post('/feedback', 'ContactAdminController@sendMail')->name('contact-admin');


Route::get('/brochure', function() {
    return response()->file(public_path('brochure.pdf'));
});