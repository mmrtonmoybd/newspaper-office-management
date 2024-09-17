<?php

use App\Http\Controllers\Ads\AdvertismentPanel\AdvertismentPanel;
use App\Http\Controllers\Ads\An\AdsAnController;
use App\Http\Controllers\Ads\Ass\AdsAsController;
use App\Http\Controllers\Cashbook\CalculationController;
use App\Http\Controllers\Cashbook\CategoryController;
use App\Http\Controllers\Press\PressPaperController;
use App\Http\Controllers\Press\PressPlateController;
use Illuminate\Support\Facades\Route;

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

    Route::get('/clear', function () {
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:clear');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('event:clear');
        // return what you want
    });

    Route::get('/cache', function () {
        $exitCode = Artisan::call('optimize');
        $exitCode = Artisan::call('config:cache');
        $exitCode = Artisan::call('route:cache');
        $exitCode = Artisan::call('view:cache');
        $exitCode = Artisan::call('event:cache');
        // return what you want
    });

    Route::get('/storagelink', function () {
        $exitCode = Artisan::call('storage:link');
        // return what you want
    });

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

    Route::group(['prefix' => 'press'], function () {
        Route::resource('paper', PressPaperController::class)->middleware('ability:admin,press_paper')->names('paper');
        Route::resource('plate', PressPlateController::class)->names('plate');
        Route::get('test/{plate}', [PressPlateController::class, 'delete']);
    });

});
