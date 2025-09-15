<?php

use App\Models\Geo;
use App\Models\Sale;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Posaudit;
use App\Models\Territory;
use App\Models\Competitor;
use App\Models\Organization;
use App\Models\PosauditItem;
use App\Models\Offplanrequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\ClockinController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClockoutController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\PosauditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderNoteController;
use App\Http\Controllers\RouteplanController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\CompetitorController;
use App\Http\Controllers\TargetGroupController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\OffplanrequestController;
use App\Http\Controllers\api\RoutePlanController as ApiRoutePlanController;

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
Route::middleware(['authCustomCheck'])->group(function(){

Route::get('/', [DashboardController::class,'index']);

Route::get('/dashboard', [DashboardController::class,'index']);

Route::get('/dealsold', [SaleController::class,'index']);
Route::get('/dealsmap', [SaleController::class,'showSalesMap']);
Route::get('/sales/filter', [SaleController::class,'filterSales']);
Route::get('/dealstargets', [SaleController::class,'showSalesTargets']);
Route::get('/dealstargetswind', [SaleController::class,'showSalesTargetsWind'])->name('dealstargetswind');
Route::get('/add-sale', [SaleController::class,'addSale']);
Route::get('/dealsanalytics', [SaleController::class,'showSalesAnalytics']);
Route::get('/sales/{id}/{object}',[SaleController::class,'showSalesById']);
Route::post('/savesale', [SaleController::class,'saveSale']);
Route::get('/deletesale/{id}', [SaleController::class,'deleteSale']);
Route::get('/editsale/{id}',[SaleController::class,'showEditSale']);
Route::get('/sale/{id}',[SaleController::class,'showEditSale']);
Route::put('/saveeditsale/{id}',[SaleController::class,'saveEditSale']);
Route::get('/dealsyajra',[SaleController::class,'salesYajra'])->name('salesyajra');
Route::get('/deals',[SaleController::class,'indexSalesYajra'])->name('indexsalesyajra');

$user = Auth::user();
Route::middleware(['ensureViewOnlyForTeamLeads'])->group(function () {

Route::get('/products', [ProductController::class,'index']);
Route::get('/deleteproduct/{id}', [ProductController::class,'deleteProduct']);
Route::get('/add-product', [ProductController::class,'addProduct']);
Route::post('/saveproduct', [ProductController::class,'saveProduct']);
Route::get('/editproduct/{id}', [ProductController::class,'showEditProduct']);
Route::put('/saveeditproduct/{id}',[ProductController::class,'saveEditProduct']);
Route::get('/add-product', [ProductController::class,'addProduct']);

Route::get('/testcompress', [ProductController::class,'testCompress']);

Route::get('/services', [ProductController::class,'services']);
Route::get('/add-service', [ProductController::class,'addService']);
Route::get('/editservice/{id}', [ProductController::class,'showEditService']);
Route::post('/saveservice', [ProductController::class,'saveService']);
Route::get('/deleteservice/{id}', [ProductController::class,'deleteService']);
Route::put('/saveeditservice/{id}',[ProductController::class,'saveEditService']);

Route::get('/ajaxservicesyajra',[ProductController::class,'ajaxservicesYajraTest'])->name('yajratest');
Route::get('/servicesyajra',[ProductController::class,'viewservicesYajraTest']);

});

Route::get('/posaudits', [PosauditController::class,'index']);
Route::get('/deleteposaudits/{id}', [PosauditController::class,'deletePosaudit']);
Route::get('/posaudit/{id}',[PosauditController::class,'showEditPOSAudit']);
Route::post('/saveeditposaudit/{id}',[PosauditController::class,'saveEditPOSAudit']);
Route::get('/posaudits/{id}/{object}',[PosauditController::class,'showPosauditsById']);
//Route::post('/posaudit',[PosauditController::class,'showEditPOSAudit'])->name('editposaudit');

Route::get('/competitors', [CompetitorController::class,'index']);
Route::get('/deletecompetitiveanalysis/{id}', [CompetitorController::class,'deleteCompetitiveAnalysis']);
Route::get('/competitiveanalysis/{id}',[CompetitorController::class,'showEditCompetitiveAnalysis']);
Route::put('/saveeditcompetitiveanalysis/{id}',[CompetitorController::class,'saveEditCompetitiveAnalysis']);
Route::get('/competitiveanalysis/{id}/{object}',[CompetitorController::class,'showCompetitiveAnalysisById']);

Route::get('/feedback', [FeedbackController::class,'index']);
Route::get('/addfeedback/{id}', [FeedbackController::class,'showAddFeedback']);
Route::post('/savefeedback', [FeedbackController::class,'saveFeedback']);
Route::get('/deletefeedback/{id}', [FeedbackController::class,'deleteFeedback']);
Route::get('/feedback/{id}',[FeedbackController::class,'showEditFeedback']);
Route::put('/saveeditfeedback/{id}',[FeedbackController::class,'saveEditFeedback']);
Route::get('/feedback/{id}/{object}',[FeedbackController::class,'showFeedbackById']);
Route::get('/feedbackyajra',[FeedbackController::class,'feedbackYajra'])->name('feedbackyajra');
Route::get('/feedback',[FeedbackController::class,'indexFeedbackYajra'])->name('indexfeedbackyajra');



Route::get('/followups', [FollowupController::class,'index']);
Route::get('/deletefollowup/{id}', [FollowupController::class,'deleteFollowup']);
Route::get('/editfollowup/{id}',[FollowupController::class,'showEditFollowup']);
Route::put('/saveeditfollowup/{id}',[FollowupController::class,'saveEditFollowup']);
Route::get('/followup/{id}/{object}',[FollowupController::class,'showFollowupById']);

Route::get('/customersold', [OutletController::class,'index']);
Route::get('/outlets/{id}/{object}', [OutletController::class,'showOutletsById']);
Route::get('/deletecustomer/{id}', [OutletController::class,'deleteOutlet']);
Route::get('/add-customer', [OutletController::class,'addOutlet']);
Route::post('/saveoutlet', [OutletController::class,'saveOutlet']);
Route::get('/editcustomer/{id}',[OutletController::class,'showEditOutlet']);
Route::put('/saveeditoutlet/{id}',[OutletController::class,'saveEditOutlet']);
Route::get('/showcustomersmap',[OutletController::class,'showOutletsMap']);
Route::get('/outlets/filter', [OutletController::class,'filterOutlets']);


Route::get('/ajaxoutletsyajra',[OutletController::class,'ajaxoutletsYajraTest'])
->name('yajratestoutlets');
Route::get('/customers',[OutletController::class,'viewoutletsYajraTest']);
Route::get('/customers/export', [OutletController::class, 'export'])->name('customers.export');

Route::get('/routeplans', [RouteplanController::class,'index']);
Route::get('/createrouteplan', [RouteplanController::class,'createRoutePlan']);
Route::get('/updateoutletscreaterouteplan/{id}', [RouteplanController::class,'updateOutletsCreateRoutePlan']);
Route::post('/saverouteplan', [RouteplanController::class,'saveRoutePlan']);
Route::post('/pushoutletstorouteplan', [RouteplanController::class,'pushOutletsToRoutePlan']);
Route::get('/pushoutletstorouteplan', [RouteplanController::class,'debugToRoutePlan']);
Route::get('/deleterouteplan/{id}', [RouteplanController::class,'deleteRoutePlan']);
Route::get('/routeplan/{id}',[RouteplanController::class,'showEditRoutePlan']);
Route::put('/saveeditrouteplan/{id}',[RouteplanController::class,'saveEditRoutePlan']);
Route::get('/routeplans/{id}/{object}',[RoutePlanController::class,'showRoutePlansById']);

Route::get('/clockins', [ClockinController::class,'index']);
Route::get('/clockin/{id}',[ClockinController::class,'showEditClockin']);
Route::get('/clockins/{id}/{object}',[ClockinController::class,'showClockinsById']);
Route::get('/clockinsmap', [ClockinController::class,'showClockinsMap']);
Route::get('/clockinsanalytics', [ClockinController::class,'showClockinsAnalytics']);
Route::get('/clockins/filter', [ClockinController::class,'filterClockins']);
Route::get('/fetchclockinanalytics', [ClockinController::class,'filterClockinsAnalytics']);


Route::get('/clockouts', [ClockoutController::class,'index']);
Route::get('/clockouts/{id}/{object}',[ClockoutController::class,'showClockoutsById']);
Route::get('/clockout/{id}',[ClockoutController::class,'showEditClockout']);
Route::get('/clockoutsmap', [ClockoutController::class,'showClockoutsMap']);
Route::get('/clockouts/filter', [ClockoutController::class,'filterClockouts']);
Route::get('/deleteclockout/{id}', [ClockoutController::class,'deleteClockout']);

//Test
//Test
// web.php
Route::get('/dayroutes', [ClockinController::class,'indexVisitsYajra']);
Route::get('/clockins/yajra', [ClockinController::class, 'clockinsVisitsYajra'])->name('clockins.yajra');

Route::get('/visitsold', [VisitController::class,'index']);
Route::get('/visit/{id}',[VisitController::class,'showEditVisit']);
Route::get('/visitsmap', [VisitController::class,'showVisitsMap']);
Route::get('/dayroutesold', [VisitController::class,'showRoutes']);
Route::get('/dayroutes/{id}', [VisitController::class,'showRoutesById']);
Route::get('/visitsanalytics', [VisitController::class,'showVisitsAnalytics']);
Route::get('/visits/{id}/{object}',[VisitController::class,'showVisitsById']);
Route::get('/visits/filter', [VisitController::class,'filterVisits']);
Route::get('/visits', [VisitController::class,'indexYajra']);
Route::get('/visitsyajra',[VisitController::class,'visitsYajra'])
->name('visitsyajra');
Route::get('/checkout/{id}', [VisitController::class,'checkout']);
Route::get('/visits/export', [VisitController::class, 'export'])->name('visits.export');


Route::get('/ordernote/{id}',[OrderNoteController::class,'index']);
Route::get('/download-pdf/{id}', [OrderNoteController::class, 'downloadPdf']);

Route::get('/targetgroups', [TargetGroupController::class,'index']);
Route::get('/add-target-group', [TargetGroupController::class,'addTargetGroup']);
Route::get('/deletetargetgroup/{id}', [TargetGroupController::class,'deleteTargetGroup']);
Route::post('/savetargetgroup', [TargetGroupController::class,'saveTargetGroup']);
Route::get('/edittargetgroup/{id}', [TargetGroupController::class,'showEditTargetGroup']);
Route::put('/saveedittargetgroup/{id}',[TargetGroupController::class,'saveEditTargetGroup']);
//test

Route::get('/territories', [TerritoryController::class,'index']);
Route::get('/add-territory', [TerritoryController::class,'addTerritory']);
Route::post('/saveterritory', [TerritoryController::class,'saveTerritory']);
Route::get('/deleteterritory/{id}', [TerritoryController::class,'deleteTerritory']);
Route::get('/editterritory/{id}', [TerritoryController::class,'showEditTerritory']);
Route::put('/saveeditterritory/{id}',[TerritoryController::class,'saveEditTerritory']);

Route::get('/profile', [UserController::class,'showProfile']);

Route::get('/adduserstotargetgroups', [UserController::class,'showAddUsersToTargetGroups']);
Route::post('/pushuserstotargetgroup', [UserController::class,'addUsersToTargetGroup']);

Route::get('/adduserstoteam', [UserController::class,'showAddUsersToTeam']);
Route::get('/addsellerstoteam/{id}', [UserController::class,'showAddUsersToSpecificTeam']);

Route::post('/pushuserstoteam', [UserController::class,'addUsersToTeam']);

Route::get('/allocateoutletstousers', [OutletController::class,'showAddOutletsToUsers']);
Route::post('/pushoutletstouser', [OutletController::class,'pushOutletsToUser']);

Route::get('/sellers', [UserController::class,'sellers']);
Route::get('/sellersreport', [UserController::class,'sellersreport']);
Route::get('/sellers/{id}/{object}',[UserController::class,'showSellersById']);
Route::get('/deleteseller/{id}', [UserController::class,'deleteSeller']);
Route::post('/saveseller', [UserController::class,'saveSeller']);
Route::get('/add-seller', [UserController::class,'addSeller']);
Route::get('/editseller/{id}', [UserController::class,'showEditSeller']);
Route::put('/saveeditseller/{id}',[UserController::class,'saveEditSeller']);

Route::get('/offplanrequests', [OffplanrequestController::class,'index']);
Route::get('/editoffplanrequest/{id}', [OffplanrequestController::class,'showEditOffplanrequest']);
Route::put('/saveeditoffplanrequest/{id}',[OffplanrequestController::class,'saveEditOffplanrequest']);



// $user = auth()->user();
Route::middleware(['adminOnly'])->group(function(){
// if(auth()->user()){


Route::get('/teams', [TeamController::class,'index']);
Route::get('/addteam', [TeamController::class,'addTeam']);
Route::get('/deleteteam/{id}', [TeamController::class,'deleteTeam']);
Route::post('/saveteam', [TeamController::class,'saveTeam']);
Route::get('/editteam/{id}', [TeamController::class,'showEditTeam']);
Route::put('/saveeditteam/{id}',[TeamController::class,'saveEditTeam']);

Route::get('/admins', [UserController::class,'admins']);
Route::get('/admins/{id}/{object}',[UserController::class,'showAdminsById']);
Route::get('/deleteadmin/{id}', [UserController::class,'deleteAdmin']);
Route::post('/saveadmin', [UserController::class,'saveAdmin']);
Route::get('/add-admin', [UserController::class,'addAdmin']);
Route::get('/editadmin/{id}', [UserController::class,'showEditAdmin']);
Route::put('/saveeditadmin/{id}',[UserController::class,'saveEditAdmin']);

Route::get('/teamleads', [UserController::class,'teamleads']);
Route::get('/teamleads/{id}/{object}',[UserController::class,'showTeamleadsById']);
Route::get('/deleteteamlead/{id}', [UserController::class,'deleteTeamlead']);
Route::get('/add-teamlead', [UserController::class,'addTeamlead']);
Route::post('/saveteamlead', [UserController::class,'saveTeamlead']);
Route::get('/editteamlead/{id}', [UserController::class,'showEditTeamlead']);
Route::put('/saveeditteamlead/{id}',[UserController::class,'saveEditTeamlead']);

Route::get('/regions', [RegionController::class,'index']);
Route::get('/add-region', [RegionController::class,'addRegion']);
Route::post('/saveregion', [RegionController::class,'saveRegion']);
Route::get('/deleteregion/{id}', [RegionController::class,'deleteRegion']);
Route::get('/editregion/{id}', [RegionController::class,'showEditRegion']);
Route::put('/saveeditregion/{id}',[RegionController::class,'saveEditRegion']);


Route::get('/tempcalculatedurations', [VisitController::class,'tempCalculateDurations']);

// }

// Route::get('/changepasswordadmin/{id}', [UserController::class,'showChangePasswordAdmin']);
// Route::put('/savepasswordadmin/{id}',[UserController::class,'saveChangePasswordAdmin']);

});

Route::middleware(['superAdminOnly'])->group(function(){
    Route::get('/organizations', [OrganizationController::class,'index']);
    Route::get('/addorganization', [OrganizationController::class,'addOrganization']);
    Route::get('/editorganization/{id}', [OrganizationController::class,'showEditOrganization']);
    Route::post('/saveorganization', [OrganizationController::class,'saveOrganization']);
    Route::put('/saveeditorganization/{id}',[OrganizationController::class,'saveEditOrganization']);
});

Route::get('/changepassword/{usertype}/{id}', [UserController::class,'showChangePassword']);
Route::put('/savechangepassword/{id}',[UserController::class,'saveChangePassword']);

Route::get('/showimage/{folder}/{image}', [ImageController::class,'showImage']);

// Route::get('/test',[FeedbackController::class,'import']);
Route::get('/file-import',[FeedbackController::class,
'importView'])->name('import-view'); 
Route::post('/import',[FeedbackController::class,
'import'])->name('import'); 
// Route::get('/export-feedback',[FeedbackController::class,
// 'exportFeedback'])->name('export-feedback');


Route::get('/run-artisan-link', function () {
    $exitCode =Artisan::call('storage:link');
    return $exitCode;
});
Route::get('/check-storage-link', function () {
    
    if (is_link(public_path('storage')) && readlink(public_path('storage')) == realpath(storage_path('app/public'))) {
        return 'The storage link is correctly set up.';
    } else {
        return 'The storage link is not correctly set up.';
    }
});

});

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password.get');
Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('forgot.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/login', [LoginController::class,'showLogin'])->name('login');
Route::post('/attemptlogin', [LoginController::class,'doLogin']);
Route::get('/logout', [LoginController::class,'logout']);
Route::get('/signup', [SignupController::class,'showSignup'])->name('notwork');
Route::post('/attemptsignup', [SignupController::class,'doSignup']);
