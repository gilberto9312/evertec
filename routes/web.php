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


Route::get('/', [App\Http\Controllers\OrdersController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\OrdersController::class, 'index'])->name('home');
Route::get('/create', [App\Http\Controllers\OrdersController::class, 'create'])->name('createOrder');
Route::post('/create', [App\Http\Controllers\OrdersController::class, 'store'])->name('createOrderStore');
Route::get('/edit/{id}', [App\Http\Controllers\OrdersController::class, 'edit'])->name('editOrder');
Route::delete('/delete/{id}', [App\Http\Controllers\OrdersController::class, 'destroy'])->name('deleteOrder');