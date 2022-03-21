<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

Route::delete('/company/{id}/destroy', [CompanyController::class, 'destroy'])->name('company.destroy');

Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::post('/company', [CompanyController::class, 'store'])->name('company.store');

Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->name('company.destroy');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



