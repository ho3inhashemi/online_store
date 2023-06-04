<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
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


Route::prefix('/auth')->group(function(){
    Route::post('/register' , [UsersController::class , 'register'])->name('auth-register');
    Route::post('/login' , [UsersController::class , 'login'])->name('auth-login');
});


Route::group(['middleware' => ['auth:sanctum']] , function(){
    Route::post('/logout' , [UsersController::class , 'logOut'])->name('auth-logout');
});
