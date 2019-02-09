<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->get('/events', 'ApiController@getEvents');
Route::middleware('api')->get('/workshops', 'ApiController@getWorkshops');
Route::middleware('api')->get('/user/regs', 'ApiController@getRegistrations');

Route::middleware('api')->get('/allevents', 'ApiController@getAllEvents');
Route::middleware('api')->get('/allworkshops', 'ApiController@getAllWorkshops');

Route::middleware('api')->get('/banners', 'ApiController@getBanners');

Route::middleware('api')->get('/getEvent', 'ApiController@getEventById');
Route::middleware('api')->get('/getWorkshop', 'ApiController@getWorkshopById');

Route::middleware('api')->get('/user/profile', 'ApiController@getUserProfile');
Route::middleware('api')->get('/getUserById', 'ApiController@getUserById');