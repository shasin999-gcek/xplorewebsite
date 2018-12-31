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


use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


Route::get('/test', function() {
	$json_file_path = storage_path('app/xplore-19-firebase-adminsdk-nruu5-850911ab91.json');
	$serviceAccount = ServiceAccount::fromJsonFile($json_file_path);

	$firebase = (new Factory)
	    ->withServiceAccount($serviceAccount)
	    ->create();

	$auth = $firebase->getAuth();

	$userProperties = [
	    'email' => 'user@example.com',
	    'emailVerified' => false,
	    'phoneNumber' => '+15555550100',
	    'password' => 'secretPassword',
	    'displayName' => 'Shimbu annan',
	    'photoUrl' => 'http://www.example.com/12345678/photo.png',
	    'disabled' => false,
	];

	$createdUser = $auth->createUser($userProperties);

	dd($createdUser);
});