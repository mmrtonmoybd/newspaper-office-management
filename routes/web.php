<?php

use App\Http\Controllers\Ads\Ass\AdsAsController;
use App\Http\Controllers\Ads\An\AdsAnController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

$default = [
    'prefix'     => config('boilerplate.app.prefix', ''),
    'domain'     => config('boilerplate.app.domain', ''),
    'middleware' => [
        'web',
        'boilerplatelocale',
        'boilerplateauth',
        'ability:admin,backend_access', 'boilerplate.emailverified',
    ],
    'as'         => 'backend.'
];



    Route::group($default, function() {

        Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
            Route::resource('an', AdsAnController::class)->middleware('ability:admin,an_permission')->names('an');
        });

        Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
            Route::resource('as', AdsAsController::class)->middleware('ability:admin,as_permission')->names('as');
        });
    });