<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::group(['prefix' => 'team/{id}', 'as' => 'team.'], function () {
    Route::get('/', 'TeamController@show')->name('show');
    Route::get('objective', 'ObjectiveController@create')->name('objective.create');
    Route::post('objective', 'ObjectiveController@store')->name('objective.store');
});
