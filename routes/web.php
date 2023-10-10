<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\EventosController;
Route::get('/', [EventosController::class, 'index']);
Route::resource('eventos', EventosController::class);

Auth::routes();
Route::resource('eventos','App\Http\Controllers\EventosController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
