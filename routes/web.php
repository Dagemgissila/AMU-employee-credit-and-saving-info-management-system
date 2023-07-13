<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Manager\ShareController;
use App\Http\Controllers\Admin\AdminUserConroller;
use App\Http\Controllers\Manager\CreditController;
use App\Http\Controllers\Manager\MemberController;
use App\Http\Controllers\Manager\SavingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\NewpasswordController;
use App\Http\Controllers\Auth\ResetpasswordController;
use App\Http\Controllers\Auth\ForgetpasswordController;
use App\Http\Controllers\Manager\ManagerUserController;
use App\Http\Controllers\Member\MemberCreditController;
use App\Http\Controllers\Member\MemberProfileController;
use App\Http\Controllers\Member\SavingAccountController;
use App\Http\Controllers\Member\MemberDashboardController;
use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Admin\AdminChangepasswordController;
use App\Http\Controllers\Member\MemberChangepasswordController;
use App\Http\Controllers\Manager\ManagerChangepasswordController;

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
    Route::get('/manager/changepassword',[ManagerChangepasswordController::class,'index'])->name('manager.changepassword');
    Route::post('/manager/changepassword',[ManagerChangepasswordController::class,'changepassword'])->name('manager.changepasswsord');
    Route::get('/manager/manage-member/addmember',[MemberController::class,'index'])->name('manager.addmembers');
    Route::post('/manager/manage-member/addmember',[MemberController::class,'addmember'])->name('manager.addmembers');
    Route::post('/manager/manage-member/addmembers',[MemberController::class,'UploadMemberExcel'])->name('manager.uploadmember');
    Route::get('/manager/manage-member/view-member-info',[MemberController::class,'ViewMemberInfo'])->name('manager.viewmember');
    Route::get('/manager/manage-member/edit-member/{id}',[MemberController::class,'show'])->name('manager.editMember');
    Route::put('/manager/manage-member/edit-member/{id}',[MemberController::class,'editmember'])->name('manager.editMember');
    Route::get('/manager/manage-saving/saving-list',[SavingController::class,'savinglist'])->name('manager.savinglist');
    Route::get('manager/manage-saving/view-detail/{id}',[SavingController::class,'viewdetail'])->name('saving.viewdetail');
    Route::get('/manager/manage-saving/create-saving-account',[SavingController::class,'CreateSavingForm'])->name('manager.createsaving');
    Route::post('/manager/manage-saving/create-saving-account',[SavingController::class,'CreateSaving'])->name('manager.createsaving');
    Route::get('/manager/manage-saving/make-deposit',[SavingController::class,'deposit'])->name('manager.makedeposit');
    Route::post('manager/manage-saving/make-deposit',[SavingController::class,'storemoney'])->name('manager.makedeposit');
    Route::post('/manager/manage-saving/delete-saving',[SavingController::class,'deletesaving'])->name('delete.saving');
    Route::post('/manager/manage-saving/upload-deposit',[SavingController::class,'uploaddeposit'])->name('manager.uploaddeposit');
    Route::get('manager/manage-credit/addcredit',[CreditController::class,'index'])->name('manager.creditform');
    Route::post('manager/manage-credit/addcredit',[CreditController::class,'addcredit'])->name('manager.addcredit');
    Route::post('manager/manage-credit/loan-calculate',[CreditController::class,'calculateLoanSchedule'])->name('manager.loancalculator');
    Route::get('manager/manage-share/view-share',[ShareController::class,'index'])->name('manager.viewshare');
    Route::get('/manager/manage-account/create-account',[ManagerUserController::class,'index'])->name('manager.createaccount');
    Route::post('manager/manage-account/create-account',[ManagerUserController::class,'createAccount'])->name('manager.createaccount');
    Route::get('/manager/manage-account/user-account',[ManagerUserController::class,'listOfAccount'])->name('manager.viewaccount');
    Route::post('/status-update/{id}',[ManagerUserController::class,'updateStatus'])->name('status-update');
    Route::get('/manager/manage-account-deleteuser/{id}',[ManagerUserController::class,'deleteaccount']);
    Route::delete('/manager/manage-account-deleteuser',[ManagerUserController::class,'destroy'])->name('deleteaccount');
    Route::get('/manager/manage-account/resetpassword/{id}',[ManagerUserController::class,'resetpageview'])->name('manager.resetpassword');
    Route::post('/manager/manage-account/resetpassword/{id}',[ManagerUserController::class,'resetpassword'])->name('manager.resetpassword');
    Route::get('download/sample-file',[DownloadController::class,'download'])->name('download.samplefile');

});



//the following code allow the pages accesed only by members
Route::middleware(['auth', 'user-role:member'])->group(function () {

    Route::get('/users/dashboard',[MemberDashboardController::class,'index'])->name('member.dashboard');
    Route::get('/users/changepassword',[MemberChangepasswordController::class,'index'])->name('member.changepassword');
    Route::post('/users/changepassword',[MemberChangepasswordController::class,'changepassword'])->name('member.changepassword');
    Route::get('/users/saving-account',[SavingAccountController::class,'index'])->name('member.savingaccount');
    Route::get('/users/share',[SavingAccountController::class,'share'])->name('member.share');
    Route::get('users/user-credit',[MemberCreditController::class,'index'])->name('member.mycredit');
    Route::get('users/user-profile',[MemberProfileController::class,'index'])->name('member.profile');

});
