<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EventosController;

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

use App\Http\Controllers\NursesController;
use App\Http\Controllers\PatientsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventosController::class, 'index'])->middleware('auth');
Route::resource('eventos', EventosController::class);

Auth::routes(['register' => true, 'verify' => false]);
Route::resource('eventos', 'App\Http\Controllers\EventosController')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('nurses', NursesController::class);
Route::resource('patients', PatientsController::class);
Route::resource('clients', ClientsController::class);
