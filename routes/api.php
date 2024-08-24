<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:api')->get('/userInfo', [AuthController::class, 'userInfo']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);


Route::apiResource('companies', CompanyController::class);
Route::apiResource('employees', EmployeeController::class);
Route::get('all-companies', [CompanyController::class, 'allCompanies']);
Route::get('companies/{id}/logo', [CompanyController::class, 'getLogo']);
