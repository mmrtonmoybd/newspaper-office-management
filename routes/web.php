<?php

use App\Http\Controllers\Ads\AdvertismentPanel\AdvertismentPanel;
use App\Http\Controllers\Ads\An\AdsAnController;
use App\Http\Controllers\Ads\Ass\AdsAsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Cashbook\CashbookController;

Route::get('/', function () {
    return view('welcome');
});

$default = [
    'prefix' => config('boilerplate.app.prefix', ''),
    'domain' => config('boilerplate.app.domain', ''),
    'middleware' => [
        'web',
        'boilerplatelocale',
        'boilerplateauth',
        'ability:admin,backend_access', 'boilerplate.emailverified',
    ],
    'as' => 'backend.',
];

Route::group($default, function () {

    Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
        Route::resource('an', AdsAnController::class)->middleware('ability:admin,an_permission')->names('an');
    });

    Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
        Route::resource('as', AdsAsController::class)->middleware('ability:admin,as_permission')->names('as');
    });

    Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
        Route::resource('panel', AdvertismentPanel::class)->middleware('ability:admin,ads_panel')->names('panel');
    });

    
    Route::group(['prefix' => 'cashbook'], function () {
        Route::resource('calculations', CalculationController::class)->middleware('ability:admin,cashbook')->names('calculations');
        Route::resource('categories', CategoryController::class)->middleware('ability:admin,cashbook_entry_heading')->names('categories');
    });

    

});
