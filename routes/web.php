<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InsumosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\DashboardController;

// RUTAS PÚBLICAS (Solo invitados)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// RUTAS PROTEGIDAS (Solo autenticados)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('insumos', InsumosController::class);
    Route::resource('proveedores', ProveedoresController::class)->parameters([
    'proveedores' => 'proveedores'
]);
    Route::resource('empleados', EmpleadosController::class)->parameters([
    'empleados' => 'empleados'
]);

});


Route::get('/', function () {
    return redirect()->route('dashboard');
});