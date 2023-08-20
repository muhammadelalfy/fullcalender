<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
    ], function(){
    Route::get('admin/home',[AdminController::class,'index'])->name('adminhome');
    Route::GET('admin-login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login',[LoginController::class,'login'])->name('login.admin');
    Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    Route::resource('countries', CountryController::class);
    Route::get('countries_status',[CountryController::class,'countriesStatus'])->name('countries.status');

    //roles
    Route::resource('roles', RoleController::class);

    //admins
    Route::resource('admins', AdminsController::class);

    //users
    Route::resource('users', UsersController::class);
    

    Route::resource('settings', SettingController::class)->except(['create', 'store','destroy']);

    });
});
?>
