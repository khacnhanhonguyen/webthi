<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\trangchuClientController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\thithuController;
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

Route::get('/admin/dashboard', [AdminController::class, 'showtrangadmin'])->middleware('checkRole:1')->name('admin.dashboard');

Route::prefix('/')->middleware('mychecklogin')->group(function () {
    Route::get('/', [trangchuClientController::class, 'showtrangchu'])->name('route.dashboard');
    Route::get('/login', [loginController::class, 'showtranglogin'])->name('route.login');
    Route::post('/login-process', [loginController::class, 'authenticate'])->name('route.login.process');

    Route::post('/create-account-process', [loginController::class, 'create'])->name('route.login.create.process');
});
Route::get('/logout', [loginController::class, 'logoutProcess'])->name('route.logout');
// routes/web.php

//thi
Route::get('/thithu/start/{de_thi_id}', [thithuController::class, 'startPracticeTest'])->name('route.thithu.hien');
Route::post('/thithu/submit', [thithuController::class, 'submitPracticeTest'])->name('route.thithu.nop');



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



