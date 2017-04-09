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
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['prefix' => 'individual', 'as' => 'individual.'], function () {
        Route::get('objective/create', 'IndividualObjectiveController@create')->name('objective.create');
        Route::post('objective/store', 'IndividualObjectiveController@store')->name('objective.store');
    });
    Route::group(['prefix' => 'team/{team_id}', 'as' => 'team.'], function () {
        Route::get('/', 'TeamController@show')->name('show');
        Route::get('objective', 'TeamObjectiveController@create')->name('objective.create');
        Route::post('objective', 'TeamObjectiveController@store')->name('objective.store');
    });
    Route::group(['prefix' => 'objective/{id}', 'as' => 'objective.'], function () {
        Route::get('/', 'TeamObjectiveController@show')->name('show');
        Route::get('keyresult', 'KeyResultController@create')->name('keyresult.create');
        Route::post('keyresult', 'KeyResultController@store')->name('keyresult.store');
    });
    Route::get('keyresult/{id}', 'KeyResultController@show')->name('keyresult.show');

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::get('/', 'HomeController@index');
            Route::resource('input_periods', 'InputPeriodController');
            Route::resource('teams', 'TeamController', ['except' => ['show']]);
            Route::group(['prefix' => 'teams/{team_id}', 'as' => 'teams.'], function () {
                Route::resource('members', 'MemberController');
            });
        });
    });
});
