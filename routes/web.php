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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::group(['prefix' => 'team/{team_id}', 'as' => 'team.'], function () {
        Route::get('/', 'TeamController@show')->name('show');
        Route::get('objective', 'ObjectiveController@create')->name('objective.create');
        Route::post('objective', 'ObjectiveController@store')->name('objective.store');
    });
    Route::group(['prefix' => 'objective/{id}', 'as' => 'objective.'], function () {
        Route::get('/', 'ObjectiveController@show')->name('show');
        Route::get('keyresult', 'KeyResultController@create')->name('keyresult.create');
        Route::post('keyresult', 'KeyResultController@store')->name('keyresult.store');
    });
    Route::get('keyresult/{id}', 'KeyResultController@show')->name('keyresult.show');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::resource('input_periods', 'InputPeriodController');
    });
});
