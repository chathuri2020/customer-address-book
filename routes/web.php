<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);



Route::get('/', function () {
    return view('welcome');
})->name('welcome');  // Giving the route a name 'welcome'

Route::resource('customers', CustomerController::class);
Route::resource('projects', ProjectController::class);
