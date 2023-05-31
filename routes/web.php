<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MejaController;
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
    Route::get("home", [AdminController::class, 'index']);

    // Admin Edit Web
    Route::get("web", [WebController::class, 'show']); // Show tampilan
    Route::post("web", [WebController::class, 'createedit']); //Create Edit Insert Artikel

    // Admin Create QrCode and Table
    Route::get("meja", [MejaController::class, 'show']); //Show content
    Route::post("create", [MejaController::class, 'create']); // Store to database
    Route::get("qrcode/{id}", [MejaController::class, 'generate']); // Generate QrCode

// Route::get('/home', [App\Http\Controllers\AdminController::class, 'index']);
});
