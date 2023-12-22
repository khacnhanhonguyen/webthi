<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\trangchuClientController;
use App\Http\Controllers\loginController;
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

Route::get('/', [trangchuClientController::class, 'showtrangchu'])->name('route.dashboard');
Route::get('/thamgia', [trangchuClientController::class, 'showtrangthamgia'])->name('route.thamgia');

Route::get('/admin/dashboard', [AdminController::class, 'showtrangadmin'])->middleware('checkRole:1')->name('admin.dashboard');

Route::prefix('login')->middleware('mychecklogin')->group(function () {
    Route::get('/', [loginController::class, 'showtranglogin'])->name('route.login');
    Route::post('/login-process', [loginController::class, 'authenticate'])->name('route.login.process');

    Route::post('/create-account-process', [loginController::class, 'create'])->name('route.login.create.process');
});
Route::get('/logout', [loginController::class, 'logoutProcess'])->name('route.logout');
// routes/web.php


