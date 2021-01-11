<?php

use App\Http\Controllers\Band\BandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\{Route, Auth};

Auth::routes();

Route::get('/', HomeController::class)->name('home');



Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashbaord');

    route::prefix('bands')->group(function () {
        //Create Data
        Route::get('create', [BandController::class, 'create'])->name('bands.create');
        Route::post('create', [BandController::class, 'store']);

        //View Table
        Route::get('table', [BandController::class, 'table'])->name('bands.table');

        //Edit Data
        Route::get('{band:slug}/edit', [BandController::class, 'edit'])->name('bands.edit');
        Route::put('{band:slug}/edit', [BandController::class, 'update']);

        //Delete Data
        Route::delete('{band:slug}/delete', [BandController::class, 'destroy'])->name('bands.delete');
    });
});