<?php

use App\Http\Controllers\admin\master\categoryController;
use App\Http\Controllers\admin\master\clientController;
use App\Http\Controllers\admin\master\serviceController;
use App\Http\Controllers\admin\master\taxController;
use App\Http\Controllers\admin\master\uomController;

Route::group(['prefix' => 'category'], function () {
    Route::controller(categoryController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::get('/edit/{CID}', 'edit');
        Route::get('/restore', 'restoreView');

        Route::post('/data', 'TableView');
        Route::post('/restore-data', 'RestoreTableView');
        Route::post('/create', 'save');
        Route::post('/edit/{CID}', 'update');
        Route::post('/delete/{CID}', 'Delete');
        Route::post('/restore/{CID}', 'Restore');
    });
});

Route::group(['prefix' => 'tax'], function () {
    Route::controller(taxController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::get('/edit/{TaxID}', 'edit');
        Route::get('/restore', 'restoreView');

        Route::post('/data', 'TableView');
        Route::post('/restore-data', 'RestoreTableView');
        Route::post('/create', 'save');
        Route::post('/edit/{TaxID}', 'update');
        Route::post('/delete/{TaxID}', 'Delete');
        Route::post('/restore/{TaxID}', 'Restore');
    });
});

Route::group(['prefix' => 'unit-of-measurement'], function () {
    Route::controller(uomController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::get('/edit/{UID}', 'edit');
        Route::get('/restore', 'restoreView');

        Route::post('/data', 'TableView');
        Route::post('/restore-data', 'RestoreTableView');
        Route::post('/create', 'save');
        Route::post('/edit/{UID}', 'update');
        Route::post('/delete/{UID}', 'Delete');
        Route::post('/restore/{UID}', 'Restore');
    });
});

Route::group(['prefix' => 'services'], function () {
    Route::controller(serviceController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::get('/edit/{serviceID}', 'edit');
        Route::get('/restore', 'restoreView');

        Route::post('/data', 'TableView');
        Route::post('/restore-data', 'RestoreTableView');
        Route::post('/create', 'save');
        Route::post('/edit/{serviceID}', 'update');
        Route::post('/delete/{serviceID}', 'Delete');
        Route::post('/restore/{serviceID}', 'Restore');

        Route::post('/get/category', 'getCategory');

        Route::post('/get/tax', 'getTax');
        Route::post('/get/uom', 'getUOM');

        Route::post('/check/service-name', 'checkServiceName');
        Route::post('/check/slug', 'checkSlug');
    });
});

Route::group(['prefix' => 'clients'], function () {
    Route::controller(clientController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::get('/edit/{serviceID}', 'edit');
        Route::get('/restore', 'restoreView');

        Route::post('/data', 'TableView');
        Route::post('/restore-data', 'RestoreTableView');
         Route::post('/create', 'save');
        Route::post('/edit/{serviceID}', 'update');
        Route::post('/delete/{serviceID}', 'Delete');
        Route::post('/restore/{serviceID}', 'Restore');

        Route::post('/get/category', 'getCategory');
        Route::post('/get/tax', 'getTax');
        Route::post('/get/uom', 'getUOM');

        Route::post('/check/project-name', 'checkProjectName');
        Route::post('/check/slug', 'checkSlug');
    });
});
