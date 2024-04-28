<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/import', [ProductController::class, 'showForm'])->name('import.form');
Route::post('/import', [ProductController::class, 'import'])->name('import');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/export', [ProductController::class, 'export'])->name('export');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
