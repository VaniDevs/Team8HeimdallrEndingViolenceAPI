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

Route::get('/', function()
{
  return View::make('home');
});

Route::get('/displayusers', function()
{
  return View::make('displayusers');
});

Route::get('/createuser', function()
{
  return View::make('createuser');
});

Route::get('/documentation', function()
{
  return View::make('documentation');
});


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::post('api/auth/login', 'UserController@login');

Route::group(['prefix' => 'api', 'middleware' => ['auth:api', 'cors']], function () {
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

  // Send the video that corresponds to an incident report
  Route::post('incident/media', 'IncidentController@uploadMedia');

  Route::get('incident/media/{uuid}', 'IncidentController@getMedia');

  // ADMIN: Update an incident so that it's marked as resolved
  Route::post('incident/done', 'IncidentController@resolveIncident');

  // ADMIN: get all incident reports
  Route::get('incident/{page?}', 'IncidentController@getIncidents');
});
