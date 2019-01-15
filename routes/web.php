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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('events', 'EventController');
    Route::resource('workshops', 'WorkshopController');

    Route::get('event-registrations', 'EventRegistrationController@index')->name('event_regs.index');
    Route::get('workshop-registrations', 'WorkshopRegistrationController@index')->name('workshop_regs.index');
    Route::get('payments', 'PaymentController@index')->name('payments.index');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('auth')->name('logs');

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
    Route::post('/event/register', 'EventRegistrationController@store')->name('register');
    Route::post('/event/payment-callback', 'EventRegistrationController@paytmCallback')->name('payment.callback');
}); 

Route::group(['middleware' => 'no-cache', 'as' => 'workshop.'], function () {
    Route::post('/workshop/register', 'WorkshopRegistrationController@store')->name('register');
    Route::post('/workshop/payment-callback', 'WorkshopRegistrationController@paytmCallback')->name('payment.callback');
}); 



Route::get('/event/get-ticket/{orderId}', 'GenerateInvoicePDF@generateEventTicket')->name('event.ticket');
Route::get('/workshop/get-ticket/{orderId}', 'GenerateInvoicePDF@generateWorkshopTicket')->name('workshop.ticket');

Route::post('/feedback', 'ContactAdminController@sendMail')->name('contact-admin');