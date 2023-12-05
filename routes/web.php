<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;

//<!--===============================================================================================-->
ROUTE::VIEW('/', 'page.home')->name('home');
ROUTE::VIEW('login', 'page.login')->name('loginPage');
ROUTE::VIEW('register', 'page.register')->name('registerPage');
ROUTE::VIEW('forgotPassword', 'page.forgotpassword')->name('forgotPassword');
ROUTE::GET('reset-password/{token}', [authController::class, 'ResetPasswordPage'])->name('resetPasswordPage');
//<!--===============================================================================================-->
ROUTE::POST('registerRequest', [authController::class, 'Register'])->name('registerRequest');
ROUTE::GET('verification/{token}', [authController::class, 'verifyEmail'])->name('verification');
ROUTE::POST('forgotPasswordRequest', [authController::class, 'ForgotPasswordRequest'])->name('forgotPasswordRequest');
ROUTE::POST('resetPasswordRequest', [authController::class, 'ResetPasswordRequest'])->name('resetPasswordRequest');
ROUTE::POST('loginRequest', [authController::class, 'Login'])->name('loginRequest');
ROUTE::POST('logoutRequest', [authController::class, 'Logout'])->name('logoutRequest');
//<!--===============================================================================================-->
Route::middleware(['admin'])->group(function () {
    //<!--===============================================================================================-->
    ROUTE::VIEW('admin', 'page.admin')->name('adminPage');
    ROUTE::GET('inventory', [adminController::class, 'inventoryPage'])->name('inventoryPage');
    //<!--===============================================================================================-->
    ROUTE::POST('addInventoryRequest', [adminController::class, 'addInventory'])->name('addInventoryRequest');
    ROUTE::POST('editInventoryRequest', [adminController::class, 'editInventoryRequest'])->name('editInventoryRequest');
    //<!--===============================================================================================-->
});
//<!--===============================================================================================-->
