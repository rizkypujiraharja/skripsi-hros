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
        Route::resource('attendances', 'AttendanceController');
    }
);
