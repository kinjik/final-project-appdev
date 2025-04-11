<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/superadmin', function () {
    return view('superadmin');
})->name('superadmin');


Route::get('/sidenav', function() {
    return view(view: 'sidenav');
});

// Route::get('usermanager', function() {
//     return view(view: 'usermanagement');
// })->name('usermanager');

Route::get('usermanager', [UserManagementsController::class, 'index'])->name('usermanager');
Route::patch('/usermanagement/{id}', [UserManagementsController::class, 'update'])->name('usermanagements.update');

Route::patch('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
