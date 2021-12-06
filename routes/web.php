<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('projects', [\App\Http\Controllers\ProjectController::class, 'store']);

Route::get('houses/download/{house}', [\App\Http\Controllers\HouseController::class, 'download']);
Route::resource('houses', \App\Http\Controllers\HouseController::class);

Route::resource('offices', \App\Http\Controllers\OfficeController::class);

Route::post('shops', [\App\Http\Controllers\ShopController::class, 'store']);

Route::resource('companies', \App\Http\Controllers\CompanyController::class);
