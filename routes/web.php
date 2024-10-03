<?php

use App\Http\Controllers\Ads\AdvertismentPanel\AdvertismentPanel;
use App\Http\Controllers\Ads\An\AdsAnController;
use App\Http\Controllers\Ads\Ass\AdsAsController;
use App\Http\Controllers\Cashbook\CalculationController;
use App\Http\Controllers\Cashbook\CategoryController;
use App\Http\Controllers\Circulation\DailyController;
use App\Http\Controllers\Circulation\MonthlyController;
use App\Http\Controllers\Circulation\RepresentativeController;
use App\Http\Controllers\Press\PressInkController;
use App\Http\Controllers\Press\PressPaperController;
use App\Http\Controllers\Press\PressPlateController;
use App\Http\Controllers\Settings\SettingsController;
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
    'as' => 'backend.',
];

Route::group($default, function () {
    Route::get('/clear', function () {
        $exitCode = Artisan::call('optimize:clear');
        // return what you want
    });

    Route::get('/cache', function () {
        $exitCode = Artisan::call('optimize');
        // return what you want
    });

    Route::get('/storagelink', function () {
        $exitCode = Artisan::call('storage:link');
        // return what you want
    });

    Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
        Route::resource('as', AdsAsController::class)->middleware('ability:admin,as_permission')->names('as');
        Route::resource('an', AdsAnController::class)->middleware('ability:admin,an_permission')->names('an');
        Route::resource('panel', AdvertismentPanel::class)->middleware('ability:admin,ads_panel')->names('panel');
    });

    Route::group(['prefix' => 'cashbook'], function () {
        Route::resource('calculations', CalculationController::class)->middleware('ability:admin,cashbook')->names('calculations');
        Route::get('calculations/export/{calculation}', [CalculationController::class, 'export'])->name('export');
        Route::resource('categories', CategoryController::class)->middleware('ability:admin,cashbook_entry_heading')->names('categories');
    });

    Route::group(['prefix' => 'press'], function () {
        Route::resource('paper', PressPaperController::class)->middleware('ability:admin,press_paper')->names('paper');
        Route::resource('plate', PressPlateController::class)->middleware('ability:admin,press_plate')->names('plate');
        Route::resource('ink', PressInkController::class)->middleware('ability:admin,press_ink')->names('ink');
        //Route::get('test/{plate}', [PressPlateController::class, 'delete']);
    });

    Route::group(['prefix' => 'circulation'], function () {
        Route::resource('representative', RepresentativeController::class)->middleware('ability:admin,representative_monthly_circulation')->names('representative');
        Route::resource('monthly', MonthlyController::class)->middleware('ability:admin,monthly_circulation')->names('monthly');
        Route::resource('daily', DailyController::class)->middleware('ability:admin,daily_circulation')->names('daily');
    });

    Route::group(['prefix' => 'settings', 'middleware' => 'ability:admin,settings'], function () {
        Route::get('index', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('update', [SettingsController::class, 'update'])->name('settings.update');
    });
});
