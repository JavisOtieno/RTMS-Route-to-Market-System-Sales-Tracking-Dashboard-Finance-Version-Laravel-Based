<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\SaleController;
use App\Http\Controllers\api\VisitController;
use App\Http\Controllers\api\OutletController;
use App\Http\Controllers\api\ClockinController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ClockoutController;
use App\Http\Controllers\api\CompetitorController;
use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\FeedbackController;
use App\Http\Controllers\api\POSAuditController;

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





Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('sales',[SaleController::class,'index']);
    Route::get('dashboard',[DashboardController::class,'index']);

    Route::post('clockin',[ClockinController::class,'saveClockin']);
    Route::post('clockout',[ClockoutController::class,'saveClockout']);

    Route::post('checkin',[VisitController::class,'checkin']);
    Route::put('/checkout/{id}',[VisitController::class,'checkout']);

    Route::post('makesale',[SaleController::class,'makesale']);
    Route::post('addoutlet',[OutletController::class,'addoutlet']);
    Route::get('outlets',[OutletController::class,'index']);
    Route::get('products',[ProductController::class,'index']);

    Route::get('/profile/{id}', [ProfileController::class,'showProfile']);

    Route::post('addfeedback',[FeedbackController::class,'saveFeedback']);
    Route::get('feedback',[FeedbackController::class,'index']);

    Route::post('addcompetitoranalysis',[CompetitorController::class,'saveCompetitorAnalysis']);
    Route::get('competitiveanalysis',[CompetitorController::class,'index']);

    Route::post('addposaudit',[POSAuditController::class,'savePOSAudit']);
    Route::get('posaudits',[POSAuditController::class,'index']);

    Route::get('visits',[VisitController::class,'index']);

});

//Route::get('geos',[GeoController::class,'apiindex']);


Route::post('/login', [LoginController::class,'doLogin']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});