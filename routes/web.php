<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
Route::get('/', function(){
$companies= App\Models\Company::all();
foreach($companies as $companie){

foreach($companie->users as $user){
    echo($user['name']);
}

}
});




Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/company', [CompanyController::class, 'index'])->name('company.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
