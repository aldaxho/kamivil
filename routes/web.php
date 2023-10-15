<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AdminController;


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
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*rutas de registro*/
Route::get('/register', [RegistroController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistroController::class, 'register']);

// Rutas libre, cliente


Route::group(['middleware' => ['auth', 'role:Administrador']], function () {
    // Rutas de "Personal" con el rol "administrador"
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});
Route::group(['middleware' => ['auth', 'role:Atencion al cliente']], function () {
    // Rutas de "Personal" con el rol "Atencion al cliente"
});
