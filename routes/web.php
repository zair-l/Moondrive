<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AlquilerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.dashboard');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/propietario/dashboard', [PropietarioController::class, 'dashboard'])->middleware('auth')->name('propietario.dashboard');

Route::resource('vehiculos', VehiculoController::class);
Route::resource('marcas', MarcaController::class);
Route::delete('/vehiculos/{vehiculo}', [VehiculoController::class, 'destroy'])->name('vehiculos.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [AlquilerController::class, 'index'])->name('user.dashboard');
});

Route::get('/alquiler', [AlquilerController::class, 'index'])->name('alquiler.index');
Route::get('/alquiler/{vehiculo}', [AlquilerController::class, 'show'])->name('alquiler.show');
Route::post('/alquiler/reservar', [AlquilerController::class, 'reservar'])->name('alquiler.reservar')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/vehiculos/{vehiculo}', [AdminController::class, 'show'])->name('vehiculos.show');
    Route::post('/vehiculos/{vehiculo}/aprobar', [AdminController::class, 'aprobarVehiculo'])->name('vehiculos.aprobar');
    Route::post('/vehiculos/{vehiculo}/rechazar', [AdminController::class, 'rechazarVehiculo'])->name('vehiculos.rechazar');
});

Route::middleware(['auth'])->prefix('propietario')->name('propietario.')->group(function () {
    Route::get('reservas/{alquiler}', [PropietarioController::class, 'showReserva'])->name('reservas.show');
    Route::post('reservas/{alquiler}/aprobar', [PropietarioController::class, 'aprobarReserva'])->name('reservas.aprobar');
    Route::post('reservas/{alquiler}/rechazar', [PropietarioController::class, 'rechazarReserva'])->name('reservas.rechazar');
});

