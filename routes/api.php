<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/company', [App\Http\Controllers\Api\Company\PostCreateCompanyController::class, '__invoke']);
Route::patch('/company/{id}/enable', [App\Http\Controllers\Api\Company\PatchEnableCompanyController::class, '__invoke']);
Route::patch('/company/{id}/disable', [App\Http\Controllers\Api\Company\PatchDisableCompanyController::class, '__invoke']);
Route::get('/company', [App\Http\Controllers\Api\Company\GetListCompaniesController::class, '__invoke']);