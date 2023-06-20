<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    //kalau disini harus login dahulu
    Route::get('home', [AdminController::class, 'index']);

    // Admin Edit Web
    Route::get('web', [WebController::class, 'show']); // Show Content Website
    Route::post('web', [WebController::class, 'createedit']); //Create Edit Insert Website

    // Admin Create QrCode and Table
    Route::get('meja', [MejaController::class, 'show']); //Show Content Table
    Route::post('create', [MejaController::class, 'create']); // Store to database
    Route::get('qrcode/{id}', [MejaController::class, 'generate']); // Generate QrCode
    Route::get('mejadelete/{id?}', [MejaController::class, 'destory']); // Delete Meja

    // Admin View Transaction
    Route::get('transaksi', [TransaksiController::class, 'show']); // Show Content Transaction

    // Admin Create Menu
    Route::get('menu', [MenuController::class, 'show']); // Show Content Menu
    Route::post('menu', [MenuController::class, 'createedit']); //Create Edit Insert Menu
    Route::get('menudelete/{id?}', [MenuController::class, 'destory']); // Delete Menu

    // Admin Create User
    Route::get('user', [UserController::class, 'show']); // Show Tampilan User
    Route::post('user', [UserController::class, 'createedit']); // Create Edit Insert User
    Route::get('userdelete/{id?}', [UserController::class, 'destory']); // Delete User
// Route::get('/home', [App\Http\Controllers\AdminController::class, 'index']);
});
