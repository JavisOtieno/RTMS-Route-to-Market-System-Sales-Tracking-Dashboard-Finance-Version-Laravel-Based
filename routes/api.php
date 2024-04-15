<?php

use App\Http\Controllers\api\ClockinController;
use App\Http\Controllers\api\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\api\SaleController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PosauditController;

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

//Route::get('geos',[GeoController::class,'apiindex']);
Route::get('sales',[SaleController::class,'index']);
Route::get('dashboard',[DashboardController::class,'index']);
Route::get('outlets',[OutletController::class,'apiindex']);
Route::get('posaudits',[PosauditController::class,'apiindex']);

Route::get('clockin',[ClockinController::class,'create']);
