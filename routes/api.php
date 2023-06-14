<?php

use App\Http\Controllers\Admin\UsersController as AdminUsersController;
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


Route::group(['prefix' => '/auth'] ,function(){
    Route::post('/register' , [UsersController::class , 'register'])->name('auth-register');
    Route::post('/login' , [UsersController::class , 'login'])->name('auth-login');

    Route::group(['middleware' => ['auth:sanctum']] , function(){
        Route::post('/logout' , [UsersController::class , 'logOut'])->name('auth-logout');
    });
});


Route::group(['middleware' => ['auth:sanctum'] , 'prefix' => '/admin'] , function(){
    Route::prefix('users')->group(function(){
        Route::post('/' , [AdminUsersController::class , 'store'])->name('admin-users-store');
        Route::get('/' , [AdminUsersController::class , 'index'])->name('admin-users-index');
        Route::get('/{user}' , [AdminUsersController::class , 'show'])->name('admin-users-show');
        Route::put('/{user}' , [AdminUsersController::class , 'update'])->name('admin-users-update');
        Route::delete('/' , [AdminUsersController::class , 'destroy'])->name('admin-users-destroy');
        Route::patch('/block' , [AdminUsersController::class , 'block'])->name('admin-users-block');
        Route::patch('/unblock' , [AdminUsersController::class , 'unblock'])->name('admin-users-unblock');
    });
});
