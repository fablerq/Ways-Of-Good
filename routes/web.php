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

# Vk authorization
Route::group(['prefix' => 'auth'], function () {
    Route::get('vk', 'VkAuthController@redirectToProvider')
        ->name('auth.vk');
    Route::get('vk/callback', 'VkAuthController@handleProviderCallback')
        ->name('auth.vk.callback');

    Route::post('logout', 'VkAuthController@logout')->name('logout');
});

# For authorized users
Route::group(['middleware' => 'auth'], function () {
    Route::get('news', 'NewsController@index')->name('news');

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('promocode', 'ProfileController@promocode')->name('promocode.use');

    Route::get('rating', 'RatingController@index')->name('rating');
    Route::get('missions', 'TaskController@index')->name('missions');

    Route::get('fortune', 'FortuneController@index')->name('fortune');
    Route::post('fortune/start', 'FortuneController@start')->name('fortune.start');

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('tasks', 'TaskController');
});

Route::auth();
Route::get('/home', 'HomeController@index');

#Registration
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

#Auth
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
