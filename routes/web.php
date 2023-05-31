<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminUserConroller;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\NewpasswordController;
use App\Http\Controllers\Auth\ResetpasswordController;
use App\Http\Controllers\Auth\ForgetpasswordController;
use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Admin\AdminChangepasswordController;

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

Route::redirect('/', '/login');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::Class,'UserLogin'])->name('login.userlogin');

Route::get('/install',[InstallController::class,'index'])->name('install');
Route::post('/install',[InstallController::class,'create'])->name('admin.register');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/forget-password',[ForgetpasswordController::class,'index'])->name('forget-password');
Route::get('/reset-password',[ResetpasswordController::class,'index'])->name('reset-password');
Route::get('/new-password',[NewpasswordController::class,'index'])->name('new-password');




//the following code allow the pages accesed only by admin
Route::middleware(['auth', 'user-role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/manage-account/create-account', [AdminUserConroller::class,'index'])->name('admin.create');
    Route::post('/admin/manage-account/create-account', [AdminUserConroller::class,'create'])->name('admin.create');
    Route::get('/admin/manage-account/list-of-user', [AdminUserConroller::class,'listofuser'])->name('admin.listofuser');
  Route::post('/status-update/{id}',[AdminUserConroller::class,'updateStatus'])->name('status-update');
  Route::get('/admin/manage-account/list-of-user/resetpassword/{id}',[AdminUserConroller::class,'resetpageview'])->name('admin.resetpassword');
  Route::post('/admin/manage-account/list-of-user/resetpassword/{id}',[AdminUserConroller::class,'resetpassword'])->name('admin.resetpassword');
Route::delete('/users/{user}',[AdminUserConroller::class,'destroy'])->name('users.destroy');
Route::get('/updateaccount/{id}',[AdminUserConroller::class,'edit']);
Route::put('update-account',[AdminUserConroller::class,'updateaccount'])->name('updateaccount');

Route::get('/deleteaccount/{id}',[AdminUserConroller::class,'deleteaccount']);
Route::delete('deleteuser',[AdminUserConroller::class,'destroy'])->name('deleteaccount');

Route::get('/admin/change-password',[AdminChangepasswordController::class,'index'])->name('admin.changepassword');
Route::post('/admin/change-password',[AdminChangepasswordController::class,'changepassword'])->name('admin.changepassword');
});


//the following code allow the pages accesed only by manager
Route::middleware(['auth', 'user-role:manager'])->group(function () {

    Route::get('/manager/dashboard', [ManagerDashboardController::class,'index'])->name('manager.dashboard');

    Route::get('/manager/manage-member/addmembers',function(){
        return view('manager.ManageMember.addmembers');
    })->name('manager.addmembers');

});



//the following code allow the pages accesed only by members
Route::middleware(['auth', 'user-role:member'])->group(function () {

    Route::get('/members/home',function(){
        return view('members.home');
    })->name('members.home');

});

