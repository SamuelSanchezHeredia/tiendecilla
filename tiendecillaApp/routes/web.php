<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendecillaController;
use App\Http\Controllers\ProductoController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [TiendecillaController::class, 'tienda'])->name('tienda');
Route::get('tienda/{id}', [ShopController::class, 'add'])->name('tienda.add');
Route::get('tienda', [TiendecillaController::class, 'producto'])->name('tienda.producto');
Route::resource('producto', ProductoController::class);

Auth::routes(['verify' => true]);



