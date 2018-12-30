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

Auth::routes();

// admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'is_admin', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('events', 'EventController');
    Route::resource('workshops', 'WorkshopController');

    // facebook sharing
    // Route::post('events/share/{event}', 'EventController@share_on_facebook')->name('share_on_fb');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/event/{slug}', 'EventController@show')->name('display_event');
Route::get('/workshop/{slug}', 'WorkshopController@show')->name('display_workshop');

Route::get('/api/events/{short_name}', 'EventController@index');