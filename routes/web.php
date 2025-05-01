<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ConcessionController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource("users", UserController::class);
Route::resource("roles", RoleController::class);

// Concession
Route::get('/concessions', [ConcessionController::class, 'index'])->name('concession.dashboard');
Route::get('/get_all_concessions', [ConcessionController::class, 'get_all_concessions'])->name('concession.list');
Route::get('/create_concession', [ConcessionController::class, 'create'])->name('concession.create');
Route::post('/save_concession', [ConcessionController::class, 'store'])->name('concession.store');
Route::get('/concession/{id}', [ConcessionController::class, 'show'])->name('concession.show');
Route::get('/concession/edit/{id}', [ConcessionController::class, 'edit'])->name('concession.edit');
Route::post('/concession/update/{id}', [ConcessionController::class, 'update'])->name('concession.update');
Route::delete('/concession/delete/{id}', [ConcessionController::class, 'destroy'])->name('concession.destroy');