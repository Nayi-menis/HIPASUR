<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importación de Controladores
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\SeguridadSaludController;
use App\Http\Controllers\FiscalizacionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ProveedorController;


// RUTA PÚBLICA
Route::get('/', function () {
    return view('index');
});

// RUTAS DE AUTENTICACIÓN (Login, Register, etc.)
Auth::routes(['register' => false]);

// RUTA HOME (ESTÁNDAR LARAVEL)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// =========================================================================
// GRUPO RAÍZ: ACCESO PARA CUALQUIER USUARIO AUTENTICADO
// =========================================================================
Route::middleware(['auth'])->group(function () {
    
    // Panel Principal (Dashboard)
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // -------------------------------------------------------------------------
    // NIVEL 1: SOLO ADMINISTRADOR (Gestión de Cuentas y Finanzas)
    // -------------------------------------------------------------------------
    Route::middleware(['role:administrador'])->group(function () {
        // Usuarios
        Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
        Route::get('/admin/usuarios/create', [UsuarioController::class, 'create'])->name('admin.usuarios.create');
        Route::post('/admin/usuarios/store', [UsuarioController::class, 'store'])->name('admin.usuarios.store');
        Route::get('/admin/usuarios/{id}', [UsuarioController::class, 'show'])->name('admin.usuarios.show');
        Route::get('/admin/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
        Route::put('/admin/usuarios/{id}', [UsuarioController::class, 'update'])->name('admin.usuarios.update');
        Route::get('/admin/usuarios/{id}/confirm-delete', [UsuarioController::class, 'confirmDelete'])->name('admin.usuarios.confirmDelete');
        Route::delete('/admin/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
        
        // Pagos / Finanzas
        Route::get('/admin/pagos', [PagoController::class, 'index'])->name('admin.pagos.index');
        Route::get('/admin/pagos/create', [PagoController::class, 'create'])->name('admin.pagos.create');
        Route::post('/admin/pagos/store', [PagoController::class, 'store'])->name('admin.pagos.store');
        Route::get('/admin/pagos/{id}', [PagoController::class, 'show'])->name('admin.pagos.show');
        Route::get('/admin/pagos/{id}/edit', [PagoController::class, 'edit'])->name('admin.pagos.edit');
        Route::put('/admin/pagos/{id}', [PagoController::class, 'update'])->name('admin.pagos.update');
        Route::get('/admin/pagos/{id}/confirm-delete', [PagoController::class, 'confirmDelete'])->name('admin.pagos.confirmDelete');
        Route::delete('/admin/pagos/{id}', [PagoController::class, 'destroy'])->name('admin.pagos.destroy');
        
        // Rutas para Proveedores
        Route::get('/admin/proveedores', [ProveedorController::class, 'index'])->name('admin.proveedores.index');
        Route::get('/admin/proveedores/create', [ProveedorController::class, 'create'])->name('admin.proveedores.create');
        Route::post('/admin/proveedores/store', [ProveedorController::class, 'store'])->name('admin.proveedores.store');

        Route::get('/admin/pagos/{id}/pdf', [App\Http\Controllers\PagoController::class, 'generarPDF'])->name('admin.pagos.pdf');
        
    });

    // -------------------------------------------------------------------------
    // NIVEL 2: ADMINISTRADOR, SECRETARIA Y ENCARGADO (Gestión Administrativa)
    // -------------------------------------------------------------------------
    Route::middleware(['role:administrador,secretaria,encargado'])->group(function () {
        
        // Módulo de Secretarias (Ahora accesible por el Encargado)
        Route::get('/admin/secretarias', [SecretariaController::class, 'index'])->name('admin.secretarias.index');
        Route::get('/admin/secretarias/create', [SecretariaController::class, 'create'])->name('admin.secretarias.create');
        Route::post('/admin/secretarias/create', [SecretariaController::class, 'store'])->name('admin.secretarias.store');
        Route::get('/admin/secretarias/{id}', [SecretariaController::class, 'show'])->name('admin.secretarias.show');
        Route::get('/admin/secretarias/{id}/edit', [SecretariaController::class, 'edit'])->name('admin.secretarias.edit');
        Route::put('/admin/secretarias/{id}', [SecretariaController::class, 'update'])->name('admin.secretarias.update');
        Route::get('/admin/secretarias/{id}/confirm-delete', [SecretariaController::class, 'confirmDelete'])->name('admin.secretarias.confirmDelete');
        Route::delete('/admin/secretarias/{id}', [SecretariaController::class, 'destroy'])->name('admin.secretarias.destroy');

        // Recursos Humanos (Personal)
        Route::get('/admin/recursos', [RecursoController::class, 'index'])->name('admin.recursos.index');
        Route::get('/admin/recursos/create', [RecursoController::class, 'create'])->name('admin.recursos.create');
        Route::post('/admin/recursos', [App\Http\Controllers\RecursoController::class, 'store'])->name('admin.recursos.store');
        Route::get('/admin/recursos/{id}', [RecursoController::class, 'show'])->name('admin.recursos.show');
        Route::get('/admin/recursos/{id}/edit', [RecursoController::class, 'edit'])->name('admin.recursos.edit');
        Route::put('/admin/recursos/{id}', [RecursoController::class, 'update'])->name('admin.recursos.update');
        Route::get('/admin/recursos/{id}/confirm-delete', [RecursoController::class, 'confirmDelete'])->name('admin.recursos.confirmDelete');
        Route::delete('/admin/recursos/{id}', [RecursoController::class, 'destroy'])->name('admin.recursos.destroy');

        // Horarios (Orden prioritario para evitar 404)
        Route::get('/admin/horarios/control', [HorarioController::class, 'control'])->name('admin.horarios.control');
        Route::resource('admin/horarios', HorarioController::class)->names('admin.horarios');
        
        // Fiscalización y Almacén
        Route::resource('admin/fiscalizacion', FiscalizacionController::class)->names('admin.fiscalizacion');
        

    });

    // -------------------------------------------------------------------------
    // NIVEL 3: ACCESO OPERATIVO (Todos los Roles + Encargado)
    // -------------------------------------------------------------------------
    Route::middleware(['role:administrador,secretaria,personal,encargado'])->group(function () {
        // Producción Minera
        Route::resource('admin/produccion', ProduccionController::class)->names('admin.produccion');
        Route::get('/admin/produccion/{id}/confirm-delete', [ProduccionController::class, 'confirmDelete'])->name('admin.produccion.confirmDelete');
        
        // Vehículos y Maquinaria
        Route::resource('admin/vehiculos', VehiculoController::class)->names('admin.vehiculos');
        Route::get('/admin/vehiculos/{id}/confirm-delete', [VehiculoController::class, 'confirmDelete'])->name('admin.vehiculos.confirmDelete');
        
        // Seguridad y Salud
        Route::resource('admin/seguridad', SeguridadSaludController::class)->names('admin.seguridad');

        Route::post('/admin/movimientos', [MovimientoController::class, 'store'])->name('movimientos.store');

        Route::resource('admin/almacen', AlmacenController::class)->names('admin.almacen');
    });
       
});
