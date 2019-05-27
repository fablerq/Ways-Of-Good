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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});


Route::resource('users', 'UserController', [
  'except' => ['edit'],
]);

Route::resource('icons', 'IconController', [
    'except' => ['edit'],
  ]);

  Route::resource('notifications', 'NotificationController', [
    'except' => ['edit'],
  ]);  

  Route::resource('organizations', 'OrganizationController', [
    'except' => ['edit'],
  ]);  

  Route::resource('places', 'PlaceController', [
    'except' => ['edit'],
  ]);  

  Route::resource('statuses', 'StatusController', [
    'except' => ['edit'],
  ]);  

  Route::resource('tags', 'TagController', [
    'except' => ['edit'],
  ]);  

  Route::resource('tickets', 'TicketController', [
    'except' => ['edit'],
  ]);  

  Route::resource('types', 'TypeController', [
    'except' => ['edit'],
  ]);  

  Route::post('tickets/{ticketId}/{tagId}', 'TicketController@addTag');
