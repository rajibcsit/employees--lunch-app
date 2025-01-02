<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LunchEntryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Employee Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/lunch', [LunchEntryController::class, 'index'])->name('lunch.index');
    Route::post('/lunch/entry', [LunchEntryController::class, 'store'])->name('lunch.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/lunch', [LunchEntryController::class, 'adminIndex'])->name('admin.lunch.index');
    Route::post('/admin/lunch/{entry}/approve', [LunchEntryController::class, 'approve'])->name('admin.lunch.approve');
    Route::post('/admin/lunch/{entry}/reject', [LunchEntryController::class, 'reject'])->name('admin.lunch.reject');
});
