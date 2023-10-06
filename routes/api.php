<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\OthersController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    //---all users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/edit/{id}', [UserController::class, 'edit']);
    Route::put('/users/update/{id}', [UserController::class, 'update']);
    Route::delete('/users/delete/{id}', [UserController::class, 'delete']);

    //---user profile
    Route::get('/user', [UserController::class, 'user']);
    Route::put('/user/update', [UserController::class, 'auth_user_update']);
    Route::patch('/user/change-password', [UserController::class, 'change_password']);
});

Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::get('/login', [AuthenticationController::class, 'login_view'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.store');

///check table existing database -----
Route::get('/check-table', [OthersController::class, 'check_table'])->name('check_table');
