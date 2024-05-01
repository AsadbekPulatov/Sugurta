<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('services', ServiceController::class)->middleware('admin');
    Route::resource('user_services', UserServiceController::class);
    Route::get('list_user_service_all', [UserServiceController::class, 'list_user_service_all'])->name('list_user_service_all');
    Route::get('user_service_status/{id}', [UserServiceController::class, 'user_service_status'])->name('user_service_status');
});

require __DIR__.'/auth.php';
