<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\MascotaUsuarioController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

//ESTA ES LA RUTA QUE TE DICE DONDE VAS A IR DEPENDIENDO EL ROL QUE TENGAS
Route::middleware(['auth'])->group(function () {
    Route::get('/empleado/dashboard', [EmpleadoController::class, 'dashboard'])->name('empleado.dashboard');
    Route::get('/empleado/usuario', [EmpleadoController::class, 'usuarios'])->name('empleado.usuario');
    Route::get('/empleado/mascotas', [EmpleadoController::class, 'mascotas'])->name('empleado.mascota');
    Route::get('/empleado/diagnostico', [EmpleadoController::class, 'diagnostico'])->name('empleado.diagnostico');
    Route::get('/empleado/facturas', [EmpleadoController::class, 'facturas'])->name('empleado.factura');
    
    // Rutas de búsqueda
    Route::get('/empleado/buscar-usuarios', [EmpleadoController::class, 'buscarUsuarios'])->name('empleado.buscar.usuarios');
    Route::get('/empleado/buscar-mascotas', [EmpleadoController::class, 'buscarMascotas'])->name('empleado.buscar.mascotas');
    Route::get('/empleado/buscar-diagnosticos', [EmpleadoController::class, 'buscarDiagnosticos'])->name('empleado.buscar.diagnosticos');
    Route::get('/empleado/buscar-facturas', [EmpleadoController::class, 'buscarFacturas'])->name('empleado.buscar.facturas');
    //Route::get('/empleados/dashboard', [EmpleadoController::class, 'mascota'])->name('empleado.dashboard');
    // crud Usuarios
    Route::get('/usuarios', [EmpleadoController::class, 'usuarios'])->name('empleado.usuarios');
    Route::get('/usuarios/crear', [EmpleadoController::class, 'createUsuario'])->name('empleado.usuarios.create');
    Route::post('/usuarios', [EmpleadoController::class, 'storeUsuario'])->name('empleado.usuarios.store');
    Route::get('/usuarios/{id}/editar', [EmpleadoController::class, 'editUsuario'])->name('empleado.usuarios.edit');
    Route::put('/usuarios/{id}', [EmpleadoController::class, 'updateUsuario'])->name('empleado.usuarios.update');
    Route::delete('/usuarios/{id}', [EmpleadoController::class, 'destroyUsuario'])->name('empleado.usuarios.destroy');

    // crud Mascotas
    
    Route::get('/mascotas/crear', [MascotaController::class, 'create'])->name('empleado.mascotas.create');
    Route::post('/mascotas', [MascotaController::class, 'store'])->name('empleado.mascotas.store');
    Route::get('/mascotas/{mascota}', [MascotaController::class, 'show'])->name('empleado.mascotas.show');
    Route::get('/mascotas/{mascota}/editar', [MascotaController::class, 'edit'])->name('empleado.mascotas.edit');
    Route::put('/mascotas/{mascota}', [MascotaController::class, 'update'])->name('empleado.mascotas.update');
    Route::delete('/mascotas/{mascota}', [MascotaController::class, 'destroy'])->name('empleado.mascotas.destroy'); 


    // crud Diagnosticos
    Route::prefix('empleado/diagnosticos')->name('empleado.diagnosticos.')->group(function () {
    //Route::get('/', [DiagnosticoController::class, 'index'])->name('index');
    Route::get('/create', [DiagnosticoController::class, 'create'])->name('create');
    Route::post('/', [DiagnosticoController::class, 'store'])->name('store');
    Route::get('/{diagnostico}/edit', [DiagnosticoController::class, 'edit'])->name('edit');
    Route::put('/{diagnostico}', [DiagnosticoController::class, 'update'])->name('update');
    Route::delete('/{diagnostico}', [DiagnosticoController::class, 'destroy'])->name('destroy');
});

    // crud Facturas
    Route::prefix('empleado/facturas')->name('empleado.facturas.')->group(function () {
        Route::get('/create', [EmpleadoController::class, 'createFactura'])->name('create');
        Route::post('/', [EmpleadoController::class, 'storeFactura'])->name('store');
        Route::get('/{id}/edit', [EmpleadoController::class, 'editFactura'])->name('edit');
        Route::put('/{id}', [EmpleadoController::class, 'updateFactura'])->name('update');
        Route::delete('/{id}', [EmpleadoController::class, 'destroyFactura'])->name('destroy');
    });

});

Route::middleware(['auth'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');
    Route::get('/cliente/facturas', [ClienteController::class, 'facturas'])->name('cliente.clienteFacturas');
    Route::get('/cliente/mascotas', [ClienteController::class, 'mascotas'])->name('cliente.clienteMascotas');
    Route::get('/cliente/diagnostico', [ClienteController::class, 'diagnostico'])->name('cliente.clienteDiagnostico');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
