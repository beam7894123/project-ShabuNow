<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function() {
    Route::post('/login','login');
    Route::post('/register','register');
//    Route::post('/updatePassword', [AuthController::class, 'updatePassword']);
    // update password
//     Route::middleware(['auth:sanctum'])->post('/updatePassword', [AuthController::class, 'updatePassword']);
    // Route::post('/update', 'update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'category'
], function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/update/{name}', [CategoryController::class, 'update']);
});

//Route::apiResource('/category', \App\Http\Controllers\Api\CategoryController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'order'
], function () {
    Route::get('{table}', [OrderController::class, 'index']);
    Route::post('store/{table}', [OrderController::class, 'store']);
    Route::get('checkPending/{table}', [OrderController::class, 'checkPending']);
    Route::post('sendOrders/{table}', [OrderController::class, 'sendOrders']);
    Route::get('show/{order}', [OrderController::class, 'show']);
    Route::get('/checkOrdered/1/', [OrderController::class, 'checkOrdered']);
    Route::put('served/{order}', [OrderController::class, 'served']);
    Route::delete('checkBill/{table}', [OrderController::class, 'checkBill']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'menu'
], function () {
    Route::post('store', [MenuController::class, 'store']);
    Route::get('show/{menu}', [MenuController::class, 'show']);
    Route::get('/', [MenuController::class, 'index']);
    Route::put('update/{menu}', [MenuController::class, 'update']);
});



Route::group([ //staff section --------------------------------------------------------------------------------------------
    'middleware' => 'api',
    'prefix' => 'staff'
], function () {
    Route::get('/', [UserController::class, 'listStaff']);
    Route::get('{user}', [UserController::class, 'show']); //show 1 User (NOT ONLY 1 STAFF)
    Route::put('{user}/update', [UserController::class, 'update']); //show 1 User (NOT ONLY 1 STAFF)
    Route::delete('{user}/delete', [UserController::class, 'destroy']);
    Route::post('create', [UserController::class, 'store']);
});

Route::group([ //customer section --------------------------------------------------------------------------------------------
    'middleware' => 'api',
    'prefix' => 'customer'
], function () {
    Route::get('/', [UserController::class, 'listCustomer']);
    Route::get('{user}', [UserController::class, 'show']); //show 1 User (NOT ONLY 1 STAFF)
    Route::put('{user}/update', [UserController::class, 'update']); //show 1 User (NOT ONLY 1 STAFF)
    Route::post('{user}/updatePassword', [UserController::class, 'updatePassword']);
    Route::delete('{user}/delete', [UserController::class, 'destroy']);
    Route::post('create', [UserController::class, 'store']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'table'
], function () {
    Route::get('/', [TableController::class, 'index']);
    Route::get('/count', [TableController::class, 'count']);
    Route::get('{table}', [TableController::class, 'show']);
    Route::post('/create', [TableController::class, 'store']);
    Route::put('/update/{table}', [TableController::class, 'update']);
    Route::delete('/delete', [TableController::class, 'destroy']);
    Route::post('/checkIn', [TableController::class, 'checkIn']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'history'
], function () {
    Route::get('/show/{user}', [HistoryController::class, 'show']);
});


Route::controller(AuthController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout','logout');
});
