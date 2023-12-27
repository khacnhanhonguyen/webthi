<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\trangchuClientController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\thichinhthucController;
use App\Http\Controllers\thithuController;
use App\Http\Controllers\thongtincuocthiController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/dashboard', [trangchuClientController::class, 'showtrangchu'])->middleware(['auth','verified'])->name('route.dashboard.login');
Route::get('/thamgia', [trangchuClientController::class, 'showtrangthamgia'])->name('route.thamgia');


Route::prefix('/admin')->middleware('checkRole:1,2')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'showtrangadmin'])->name('admin.dashboard');
    Route::get('/user/show', [AdminController::class, 'showUser'])->name('admin.showlistuser');
    Route::get('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('/users/create', [AdminController::class, 'showCreateForm'])->name('admin.users.create');
    Route::post('/users/create-process', [AdminController::class, 'create'])->name('admin.users.create-process');
    Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');

    Route::get('/dethi', [AdminController::class, 'showDethi'])->name('admin.dethi.show');
    Route::delete('/dethi/{id}', [AdminController::class, 'deleteDeThi'])->name('admin.dethi.delete');
    Route::get('/dethi/create',  [AdminController::class, 'taoDethi'])->name('admin.dethi.create');
    Route::post('/dethi/create-process', [AdminController::class, 'taoDethi_process'])->name('admin.dethi.create-process');
    Route::get('/dethi/{id}/edit', [AdminController::class, 'editDeThi'])->name('admin.dethi.edit');
    Route::put('/dethi/{id}/update', [AdminController::class, 'updateDeThi'])->name('admin.dethi.update');


    //cau hoi
    // routes/web.php hoặc routes/admin.php
    Route::get('/de-thi/{de_thi_id}/danh-sach-cau-hoi', [AdminController::class, 'showDanhSachCauHoi'])
    ->name('admin.dethi.danh-sach-cau-hoi');
    Route::get('/cau-hoi/{id}/delete',[AdminController::class, 'deleteCauHoi'] )->name('admin.cauhoi.delete');
    Route::get('/cau-hoi/{id}/edit', [AdminController::class, 'editCauHoi'] )->name('admin.cauhoi.edit');
    Route::post('/cau-hoi/{id}/update',[AdminController::class, 'updateCauHoi'] )->name('admin.cauhoi.update');
    Route::get('de-thi/{de_thi_id}/cau-hoi/create', [AdminController::class, 'createCauHoi'])->name('admin.cauhoi.create');
    Route::post('de-thi/cau-hoi/store', [AdminController::class, 'storeCauHoi'])->name('admin.cauhoi.store');
});

//login
Route::prefix('/')->middleware('mychecklogin')->group(function () {
    Route::get('/', [trangchuClientController::class, 'showtrangchu'])->name('route.dashboard');
    Route::get('/login', [loginController::class, 'showtranglogin'])->name('route.login');
    Route::post('/login-process', [loginController::class, 'authenticate'])->name('route.login.process');

    Route::post('/create-account-process', [loginController::class, 'create'])->name('route.login.create.process');
});
Route::get('/logout', [loginController::class, 'logoutProcess'])->name('route.logout');
// routes/web.php

//thi thu
Route::get('/thithu/start/{de_thi_id}', [thithuController::class, 'startPracticeTest'])->name('route.thithu.hien');
Route::post('/thithu/submit', [thithuController::class, 'submitPracticeTest'])->name('route.thithu.nop');
//tham gia thi
Route::get('/thithuc/start/{de_thi_id}', [thichinhthucController::class, 'startPractice'])->name('route.thithuc.hien');
Route::post('/thithuc/submit', [thichinhthucController::class, 'submitPractice'])->name('route.thithuc.nop');
Route::get('/xemthongtin/{de_thi_id}', [thongtincuocthiController::class, 'xemcuocthi'])->name('route.xemcuocthi.hien');

//email
Route::get('/email/verify', function () {
    return view('login.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('route.dashboard.login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



