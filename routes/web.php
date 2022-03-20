<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

Route::delete('/company/{id}/destroy', [CompanyController::class, 'destroy'])->name('company.destroy');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::post('/company', [CompanyController::class, 'store'])->name('ajaxbooks.store');
Route::put('/company', [CompanyController::class, 'store'])->name('ajaxbooks.edit');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



