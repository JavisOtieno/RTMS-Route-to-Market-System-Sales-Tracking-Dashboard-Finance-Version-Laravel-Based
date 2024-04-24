<?php

use App\Models\Geo;
use App\Models\Sale;
use App\Models\Outlet;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoController;
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
use App\Models\Posaudit;

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

Route::get('/competitors', [CompetitorController::class,'index']);
Route::get('/deletecompetitiveanalysis/{id}', [CompetitorController::class,'deleteCompetitiveAnalysis']);

Route::get('/feedback', [FeedbackController::class,'index']);
Route::get('/deletefeedback/{id}', [FeedbackController::class,'deleteFeedback']);

Route::post('/savesale', [SaleController::class,'saveSale']);

Route::get('/deletesale/{id}', [SaleController::class,'deleteSale']);

Route::get('/editsale/{id}',[SaleController::class,'showEditSale']);

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

Route::get('/clockouts', [ClockoutController::class,'index']);

Route::get('/editprofile', [UserController::class,'showProfile']);

Route::get('/visits', [VisitController::class,'index']);

Route::get('/users', [UserController::class,'index']);

Route::get('/deleteuser/{id}', [UserController::class,'deleteUser']);

Route::post('/saveuser', [UserController::class,'saveUser']);

Route::get('/add-user', [UserController::class,'addUser']);

Route::get('/edituser/{id}', [UserController::class,'showEditUser']);

Route::put('/saveedituser/{id}',[UserController::class,'saveEditUser']);

Route::get('/changepassword/{id}', [UserController::class,'showChangePassword']);

Route::put('/savechangepassword/{id}',[UserController::class,'saveChangePassword']);

});



Route::get('/login', [LoginController::class,'showLogin'])->name('login');

Route::post('/attemptlogin', [LoginController::class,'doLogin']);

Route::get('/logout', [LoginController::class,'logout']);

Route::get('/signup', [SignupController::class,'showSignup']);

Route::post('/attemptsignup', [SignupController::class,'doSignup']);
