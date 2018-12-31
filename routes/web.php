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

    // facebook sharing
    // Route::post('events/share/{event}', 'EventController@share_on_facebook')->name('share_on_fb');
});


Route::get('/home', 'HomeController@index')->name('home');

/* 
   /events/short_name 
   eg: /events/cse	
*/
Route::get('/events/{category}/', 'EventController@getEventsByCategory')->name('events');

/* 
   /events/short_name/slug 
   eg: /events/cse/the-first-event	
*/

Route::get('/events/{category}/{slug}', 'EventController@show')->name('display_event');
Route::get('/workshops/{category}/{slug}', 'WorkshopController@show')->name('display_workshop');


Route::get('/', 'Home@index');
Route::get('/about', 'Home@about');
Route::get('/contact', 'Home@contact');
Route::get('/technical', 'Home@technical');
Route::get('/cultural', 'Home@cultural');
Route::get('/management', 'Home@management');

