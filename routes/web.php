<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'ProfileController@edit')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
    Route::get('/', 'HomeController@index')->name('index');

    Route::resource('/my-attendances', 'MyAttendanceController');
});

Route::group(
    ['middleware' => ['auth', 'role:hrd']],
    function () {
        Route::resource('users', 'UserController');
        Route::get('users/{user}/overview', 'UserController@overview')->name('users.overview');
        Route::get('users/{user}/slip', 'UserController@slip')->name('users.slip');
        Route::get('users/{user}/attendances', 'UserController@attendances')->name('users.attendances');
        Route::resource('attendances', 'AttendanceController')->only(['index', 'update']);
        Route::get('attendances/process-not-present', 'AttendanceController@processNotPresent')->name('attendances.process-not-present');
    }
);


Route::group(
    ['middleware' => ['auth', 'role:finance']],
    function () {
        Route::get('salaries', 'SallaryController@index')->name('sallaries.index');
        Route::get('salaries/download-sample', 'SallaryController@downloadSample')->name('sallaries.sample');
        Route::post('salaries/import', 'SallaryController@import')->name('sallaries.import');
        Route::post('salaries/export', 'SallaryController@export')->name('sallaries.export');
        Route::get('salaries/{sallary}/slip', 'SallaryController@slip')->name('sallaries.slip');
    }
);
