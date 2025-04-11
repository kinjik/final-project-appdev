<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// (// Landing page route (login page)
//     Route::get('/', function () {
//         return view('login');
//     })->name('home');  // Added a name for easy redirection to home

//     // Show login form
//     Route::get('/logining', [AuthController::class, 'showLoginForm'])->name('login.form');  // Renamed

//     // Handle login submission
//     Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

//     // Handle logout
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//     // Authenticated routes (for both admin and superadmin dashboards)
//     Route::middleware('auth')->group(function () {
//         Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     });
//     // Route::get('superadmin/dashboard', [AdminController::class, 'superAdminDashboard'])->name('superadmin.dashboard');
// )
// Login + Logout Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group routes that require admin authentication
Route::middleware(['auth:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Super Admin Dashboard
    Route::get('/superadmin/dashboard', [AdminController::class, 'superAdminDashboard'])->name('superadmin.dashboard');
    // User Management for Super Admin
    Route::get('/superadmin/usermanagement', [AdminController::class, 'userManagementSuperAdmin'])->name('usermanagement.dashboard');
    // Update Admin
    Route::patch('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');


});

// Route::middleware('auth:admin')->group(function () {
//     Route::get('admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
//     Route::delete('admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
// });
