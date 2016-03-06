<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::post('api/auth/login', 'UserController@login');

Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {
  /*
   |--
   | Profile Routes
   |--
   */
  // Retrieve user profile information
  Route::get('profile', 'UserController@getProfile');

  // Updating the profile with new data
  Route::post('profile', 'UserController@updateProfile');

  // ADMIN: Register a new user
  Route::post('profile/new', 'UserController@newProfile');

  /*
   |--
   | Incident Routes
   |--
   */
  // Send an alert to the incident reports
  Route::post('incident', 'IncidentController@alertIncident');

  // ADMIN: Update an incident so that it's marked as resolved
  Route::post('incident/done', 'IncidentController@resolveIncident');
});
