<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');  // Giving the route a name 'welcome'

Route::resource('customers', CustomerController::class);
Route::resource('projects', ProjectController::class);
