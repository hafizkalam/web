<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebController;
use App\Models\Meja;
use App\Models\User;
use App\Models\Web;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Session\Session;

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
//localhost:8000/
Route::get('/', function () {
    $session = new Session();
    $session->set('faktur', '');
    // dd(Session::get('currency'));
    $data = Auth::routes();
    $data['meja'] = Meja::get();
    $data['user'] = User::get();
    $web = Web::get();
    foreach ($web as $value) {
        $data[$value->name] = $value->description;
    }
    // echo"<pre>";
    // print_r($data['meja']);
    // exit;
    return view('index', $data);
});

// Localhost:8000/login
Route::get('nomeja/{id?}', [WebController::class, 'showmenu']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    //kalau disini harus login dahulu
    Route::get('home', [AdminController::class, 'index']);

    // Admin Edit Web
    Route::get('web', [WebController::class, 'show']); // Show Content Website
    Route::post('web', [WebController::class, 'edit']); //Create Edit Insert Website

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
    Route::get('userdelete/{id?}/{name?}', [UserController::class, 'destory']); // Delete User
// Route::get('/home', [App\Http\Controllers\AdminController::class, 'index']);
});
