<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::group(
    ['namespace' => 'API'],
    function () {
        Route::get('/widget', 'HomeController@widget');
        Route::get('/chart-order', 'HomeController@chartOrder');
        Route::get('/chart-production', 'HomeController@chartProduction');
        Route::get('/recent-order', 'HomeController@recentOrder');
        Route::get('/recent-purchase', 'HomeController@recentPurchase');
        Route::get('/recent-production', 'HomeController@recentProduction');
    }
);
