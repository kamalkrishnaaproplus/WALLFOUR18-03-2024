<?php
use App\Http\Controllers\admin\home\bannerController;
use App\Http\Controllers\admin\home\contentController;

Route::group(['prefix'=>'banner'],function (){
    Route::controller(bannerController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/upload', 'create');
        Route::get('/edit/{TranNo}', 'edit');
        Route::post('/upload', 'save');
        Route::POST('/edit/{TranNo}', 'update');
        Route::POST('/delete/{TranNo}', 'Delete');
    });
});
Route::group(['prefix'=>'content'],function (){
    Route::controller(contentController::class)->group(function () {
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


        Route::post('/get/section-names', 'getSectionNames');
    });
});