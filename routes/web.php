<?php

use App\Http\Controllers\ImageController;
use App\Models\Geo;
use App\Models\Sale;
use App\Models\Outlet;
use App\Models\Posaudit;
use App\Models\PosauditItem;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\ClockinController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClockoutController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PosauditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompetitorController;
use App\Http\Controllers\TargetGroupController;

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
Route::middleware(['auth'])->group(function(){
Route::get('/', [DashboardController::class,'index']);

Route::get('/dashboard', [DashboardController::class,'index']);

Route::get('/sales', [SaleController::class,'index']);

Route::get('/add-sale', [SaleController::class,'addSale']);

Route::get('/outlets', [OutletController::class,'index']);

Route::get('/products', [ProductController::class,'index']);

Route::get('/posaudits', [PosauditController::class,'index']);
Route::get('/deleteposaudits/{id}', [PosauditController::class,'deletePosaudit']);
Route::get('/posaudit/{id}',[PosauditController::class,'showEditPOSAudit']);

Route::get('/competitors', [CompetitorController::class,'index']);
Route::get('/deletecompetitiveanalysis/{id}', [CompetitorController::class,'deleteCompetitiveAnalysis']);
Route::get('/competitiveanalysis/{id}',[CompetitorController::class,'showEditCompetitiveAnalysis']);

Route::get('/feedback', [FeedbackController::class,'index']);
Route::get('/deletefeedback/{id}', [FeedbackController::class,'deleteFeedback']);
Route::get('/feedback/{id}',[FeedbackController::class,'showEditFeedback']);

Route::post('/savesale', [SaleController::class,'saveSale']);
Route::get('/deletesale/{id}', [SaleController::class,'deleteSale']);
Route::get('/editsale/{id}',[SaleController::class,'showEditSale']);
Route::get('/sale/{id}',[SaleController::class,'showEditSale']);
Route::put('/saveeditsale/{id}',[SaleController::class,'saveEditSale']);

Route::get('/deleteproduct/{id}', [ProductController::class,'deleteProduct']);

Route::get('/add-product', [ProductController::class,'addProduct']);

Route::post('/saveproduct', [ProductController::class,'saveProduct']);

Route::get('/editproduct/{id}', [ProductController::class,'showEditProduct']);

Route::put('/saveeditproduct/{id}',[ProductController::class,'saveEditProduct']);

Route::get('/deleteoutlet/{id}', [OutletController::class,'deleteOutlet']);

Route::get('/add-outlet', [OutletController::class,'addOutlet']);

Route::post('/saveoutlet', [OutletController::class,'saveOutlet']);

Route::get('/editoutlet/{id}',[OutletController::class,'showEditOutlet']);

Route::put('/saveeditoutlet/{id}',[OutletController::class,'saveEditOutlet']);

Route::get('/clockins', [ClockinController::class,'index']);
Route::get('/clockin/{id}',[ClockinController::class,'showEditClockin']);

Route::get('/clockouts', [ClockoutController::class,'index']);
Route::get('/clockout/{id}',[ClockoutController::class,'showEditClockout']);

Route::get('/profile', [UserController::class,'showProfile']);

Route::get('/visits', [VisitController::class,'index']);
Route::get('/visit/{id}',[VisitController::class,'showEditVisit']);

Route::get('/targetgroups', [TargetGroupController::class,'index']);
Route::get('/add-target-group', [TargetGroupController::class,'addTargetGroup']);
Route::get('/deletetargetgroup/{id}', [TargetGroupController::class,'deleteTargetGroup']);
Route::post('/savetargetgroup', [TargetGroupController::class,'saveTargetGroup']);
Route::get('/edittargetgroup/{id}', [TargetGroupController::class,'showEditTargetGroup']);
Route::put('/saveedittargetgroup/{id}',[TargetGroupController::class,'saveEditTargetGroup']);

Route::get('/users', [UserController::class,'index']);
Route::get('/adduserstotargetgroups', [UserController::class,'showAddUsersToTargetGroups']);
Route::post('/pushuserstotargetgroup', [UserController::class,'addUsersToTargetGroup']);

Route::get('/deleteuser/{id}', [UserController::class,'deleteUser']);

Route::post('/saveuser', [UserController::class,'saveUser']);

Route::get('/add-user', [UserController::class,'addUser']);

Route::get('/edituser/{id}', [UserController::class,'showEditUser']);

Route::put('/saveedituser/{id}',[UserController::class,'saveEditUser']);

Route::get('/changepassword/{id}', [UserController::class,'showChangePassword']);

Route::put('/savechangepassword/{id}',[UserController::class,'saveChangePassword']);

Route::get('/showimage/{folder}/{image}', [ImageController::class,'showImage']);

Route::get('/run-artisan-link', function () {
    Artisan::call('storage:link');
    return 'Artisan link command executed';
});


});



Route::get('/login', [LoginController::class,'showLogin'])->name('login');

Route::post('/attemptlogin', [LoginController::class,'doLogin']);

Route::get('/logout', [LoginController::class,'logout']);

Route::get('/signup', [SignupController::class,'showSignup']);

Route::post('/attemptsignup', [SignupController::class,'doSignup']);
