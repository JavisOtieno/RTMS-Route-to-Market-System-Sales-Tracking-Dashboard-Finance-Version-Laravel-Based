<?php

use Illuminate\Http\Request;
use App\Models\Offplanrequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\LogController;
use App\Http\Controllers\api\SaleController;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\VisitController;
use App\Http\Controllers\OrderNoteController;
use App\Http\Controllers\api\OutletController;
use App\Http\Controllers\api\ClockinController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\ActivityController;
use App\Http\Controllers\api\ClockoutController;
use App\Http\Controllers\api\FeedbackController;
use App\Http\Controllers\api\POSAuditController;
use App\Http\Controllers\api\DashboardController;
use App\Http\Controllers\api\RoutePlanController;
use App\Http\Controllers\api\CompetitorController;
use App\Http\Controllers\api\OrganizationController;
use App\Http\Controllers\api\OffplanrequestController;

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





Route::middleware(['auth:sanctum','apiLimitInactiveOrganization'])->group(function(){
    Route::get('dashboard',[DashboardController::class,'index']);

    Route::post('clockin',[ClockinController::class,'saveClockin']);
    Route::post('clockout',[ClockoutController::class,'saveClockout']);

    Route::post('checkin',[VisitController::class,'checkin']);
    // Route::post('logcheckin',[LogController::class,'addlog']);
    Route::put('checkout/{id}',[VisitController::class,'checkout']);

    Route::get('sales',[SaleController::class,'index']);
    // Route::post('makesale',[SaleController::class,'makesale']);
    Route::post('addsale',[SaleController::class,'saveSale']);
    Route::post('visitsales',[SaleController::class,'visitSales']);

    Route::post('addoutlet',[OutletController::class,'addoutlet']);
    Route::get('outlets',[OutletController::class,'index']);
    Route::get('products',[ProductController::class,'index']);
    Route::get('productsinstock',[ProductController::class,'productsInStock']);

    Route::get('profile', [ProfileController::class,'showProfile']);

    Route::get('organization', [OrganizationController::class,'showOrganizationDetails']);

    Route::post('addfeedback',[FeedbackController::class,'saveFeedback']);
    Route::get('feedback',[FeedbackController::class,'index']);
    Route::post('visitfeedback',[FeedbackController::class,'visitFeedback']);

    Route::post('addcompetitoranalysis',[CompetitorController::class,'saveCompetitorAnalysis']);
    Route::get('competitiveanalysis',[CompetitorController::class,'index']);
    Route::post('visitcompetitiveanalysis',[CompetitorController::class,'visitCompetitiveAnalysis']);

    Route::post('addposaudit',[POSAuditController::class,'savePOSAudit']);
    Route::get('posaudits',[POSAuditController::class,'index']);
    Route::post('visitposaudits',[POSAuditController::class,'visitPOSAudits']);

    Route::get('visits',[VisitController::class,'index']);
    Route::post('uploadimage', [ImageController::class,'upload']);

    //post because it requires visit id as a parameter
    Route::post('activitieslist',[ActivityController::class,'index']);

    Route::get('userhasrouteplan', [RoutePlanController::class,'checkIfUserHasRoutePlanToday']);
    Route::get('routeplans',[RouteplanController::class,'index']);
    Route::post('addoffplanrequest', [OffplanrequestController::class,'saveOffplanrequest']);
    Route::get('checkifoffplanrequestapproved/{id}',[OffplanrequestController::class,'checkIfOffplanrequestApproved']);

    Route::get('download-pdf-mobile/{id}', [OrderNoteController::class, 'downloadPdf']);

    Route::put('pendingsale/{id}',[SaleController::class,'pendingSale']);
    Route::put('completesale/{id}',[SaleController::class,'completeSale']);


});

// Route::post('clockintest',[ClockinController::class,'clockinTest']);



//Route::get('geos',[GeoController::class,'apiindex']);


Route::post('/login', [LoginController::class,'doLogin']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});