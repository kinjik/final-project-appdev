<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group routes that require admin authentication
Route::middleware(['auth:admin'])->group(function () {
    // ---------------------------ADMIN---------------------------//
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/addpayment', [AdminController::class, 'showAddPaymentForm'])->name('admin.showaddpayment');
    Route::get('/admin/members', [AdminController::class, 'showMembers'])->name('admin.members');

    // ---------------------------SUPER ADMIN---------------------------//
    // Super Admin Dashboard
    Route::get('/superadmin/dashboard', [AdminController::class, 'superAdminDashboard'])->name('superadmin.dashboard');
    // User Management for Super Admin
    Route::get('/superadmin/usermanagement', [AdminController::class, 'userManagementSuperAdmin'])->name('usermanagement.dashboard');
    // Update Admin
    Route::patch('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');


    // Route::get('/student/dashboard', [StudentAuthController::class, 'dashboard'])->name('student.dashboard');
    Route::post('/students/store', [StudentController::class, 'store'])->name('admin.students.store');
    Route::patch('/students/{student}/update', [StudentController::class, 'update'])->name('admin.students.update');
    Route::patch('/students/{student}/transfer', [StudentController::class, 'transfer'])->name('admin.students.transfer');
});
Route::middleware(['auth:student'])->group(function () {
    Route::get('/student/dashboard', [StudentAuthController::class, 'dashboard'])->name('student.dashboard');
});


