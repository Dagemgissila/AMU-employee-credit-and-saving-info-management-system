<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NewpasswordController;
use App\Http\Controllers\Auth\ResetpasswordController;
use App\Http\Controllers\Auth\ForgetpasswordController;

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



Route::get('/admin/register',[InstallController::class,'index'])->name('install');
Route::post('/install',[InstallController::class,'create'])->name('admin.register');
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/forget-password',[ForgetpasswordController::class,'index'])->name('forget-password');
Route::get('/reset-password',[ResetpasswordController::class,'index'])->name('reset-password');
Route::get('/new-password',[NewpasswordController::class,'index'])->name('new-password');

Route::post('/login',[LoginController::Class,'UserLogin'])->name('login.userlogin');


//the following code allow the pages accesed only by admin
Route::middleware(['auth', 'user-role:admin'])->group(function () {

    Route::get('/admin/dashboard',function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');

});

//the following code allow the pages accesed only by manager
Route::middleware(['auth', 'user-role:manager'])->group(function () {
    Route::get('/',function(){
        return view('manager.ManageMember.addmembers');
    });

    Route::get('/manager/addmembers',function(){
        return view('manager.ManageMember.addmembers');
    })->name('manager.addmembers');

});



//the following code allow the pages accesed only by members
Route::middleware(['auth', 'user-role:member'])->group(function () {

    Route::get('/members/home',function(){
        return view('members.home');
    })->name('members.home');

});

