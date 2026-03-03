<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
Route::get('/pos/cobro', fn () => view('pos.cobro'))->name('pos');
Route::get('/usuarios', fn () => view('usuarios.index'))->name('usuarios');

// Rutas del sidebar (vistas vacías por ahora)
Route::get('/productos', fn() => view('dashboard'))->name('productos');
Route::get('/proveedores', fn() => view('dashboard'))->name('proveedores');
Route::get('/entradas', fn() => view('dashboard'))->name('entradas');
Route::get('/clientes', fn() => view('dashboard'))->name('clientes');
Route::get('/historial', fn() => view('dashboard'))->name('historial');
Route::get('/cierre', fn() => view('dashboard'))->name('cierre');
Route::get('/reportes', fn() => view('reportes.index'))->name('reportes');