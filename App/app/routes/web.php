<?php
use App\Http\Controllers\admin\loginController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\supportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
Route::controller(homeController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('/home', 'home');
    Route::get('/about-us', 'aboutUs');
    Route::get('/contact-us', 'contactUs');
    Route::get('/services', 'services');
    Route::get('/services/{Slug}', 'serviceDetails');
    Route::get('/terms-and-conditions', 'termsAndConditions');
    Route::get('/privacy-policy', 'privacyPolicy');
    Route::get('/help', 'help');

    Route::post('/get/service-enquiry-form', 'getServiceEnquiryForm');
    Route::post('/get/services', 'getServicesList');

    Route::post('/save/service-enquiry', 'ServiceEnquirySave');
    Route::post('/save/contact-enquiry', 'ContactEnquirySave');
});
Route::controller(supportController::class)->group(function () {
    Route::post('/get/country', 'GetCountry');
    Route::post('/get/states', 'GetState');
    Route::post('/get/gender', 'GetGender');
    Route::post('/get/city', 'GetCity');
    Route::post('/get/postal-code', 'getPostalCode');
});

Route::controller(loginController::class)->group(function () {
    Route::post('/auth/login', 'login');
});
require __DIR__ . '/auth.php';
Route::group(['prefix' => 'admin'], function () {
    Route::middleware('auth')->group(function () {
        require __DIR__ . '/admin/admin.php';
    });
});
