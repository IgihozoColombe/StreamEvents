<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\SubsccriberController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MerchSaleController;
use App\Http\Controllers\DashboardController;



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
Route::middleware('auth:api')->group(function () {
    // Existing routes...

    // Route to fetch followers
    Route::get('/dashboard-data', [DashboardController::class, 'dashboardData']);
    Route::get('/notifications', [DashboardController::class, 'getNotifications']);
    Route::get('/followers', [FollowerController::class, 'index']);
    Route::get('/subscribers', [SubsccriberController::class, 'index']);
    Route::get('/merchandise-sales', [MerchSaleController::class, 'index']);
    Route::get('/donations', [DonationController::class, 'index']);
    Route::put('/donations/{donation}/mark-as-read',[DonationController::class, 'markAsRead']);
    Route::put('/followers/{follower}/mark-as-read',[FollowerController::class, 'markAsRead']);
    Route::put('/subscribers/{subscriber}/mark-as-read',[SubsccriberController::class, 'markAsRead']);
    Route::put('/sale/{sale}/mark-as-read',[MerchSaleController::class, 'markAsRead']);
    Route::get('/dashboard/total-merchandise-sales', [DashboardController::class.'getTotalMerchandiseSales']);

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
