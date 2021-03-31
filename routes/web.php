<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\GenreSeedsController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RecomendationController;
use App\Http\Controllers\ResultContrller;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::resource('/', ConditionController::class, [
        'names' => [
            'index' => 'condition.index',
            'store' => 'condition.store',
        ]
    ]);

    Route::resource('/recomendation', RecomendationController::class, [
        'names' => [
            'index' => 'recomendation.index',
            'store' => 'recomendation.store',
        ]
    ]);

    Route::resource('/playlist', PlaylistController::class, [
        'names' => [
            'index'   => 'playlist.index',
            'store'   => 'playlist.store',
            'destroy' => 'playlist.destroy',
        ]
    ]);

    Route::group(['prefix' => 'result'], function() {
        Route::resource('/', ResultContrller::class);
    });


    Route::group(['prefix' => 'genre'], function() {
        Route::resource('/', GenreSeedsController::class);
    });
});
