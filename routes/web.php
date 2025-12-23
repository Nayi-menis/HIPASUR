<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
#Rutas para el administrador
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')
    ->middleware('auth'); #no pueede entrar a la ruta si no tiene la autentificacion

#Rutas para el admin-usuarios
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth'); 
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth'); 
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::get('/admin/usuarios/{id}/confirm-delete', [App\Http\Controllers\UsuarioController::class, 'confirmDelete'])->name('admin.usuarios.confirmDelete')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth');

#Rutas para el admin-secretarias
Route::get('/admin/secretarias', [App\Http\Controllers\SecretariaController::class, 'index'])->name('admin.secretarias.index')->middleware('auth'); 
Route::get('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'create'])->name('admin.secretarias.create')->middleware('auth'); 
Route::post('/admin/secretarias/create', [App\Http\Controllers\SecretariaController::class, 'store'])->name('admin.secretarias.store')->middleware('auth');
Route::get('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'show'])->name('admin.secretarias.show')->middleware('auth');
Route::get('/admin/secretarias/{id}/edit', [App\Http\Controllers\SecretariaController::class, 'edit'])->name('admin.secretarias.edit')->middleware('auth');
Route::put('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'update'])->name('admin.secretarias.update')->middleware('auth');
Route::get('/admin/secretarias/{id}/confirm-delete', [App\Http\Controllers\SecretariaController::class, 'confirmDelete'])->name('admin.secretarias.confirmDelete')->middleware('auth');
Route::delete('/admin/secretarias/{id}', [App\Http\Controllers\SecretariaController::class, 'destroy'])->name('admin.secretarias.destroy')->middleware('auth');

#Rutas para el admin-recursos humanos
Route::get('/admin/recursos', [App\Http\Controllers\RecursoController::class, 'index'])->name('admin.recursos.index')->middleware('auth'); 
Route::get('/admin/recursos/create', [App\Http\Controllers\RecursoController::class, 'create'])->name('admin.recursos.create')->middleware('auth'); 
Route::post('/admin/recursos/create', [App\Http\Controllers\RecursoController::class, 'store'])->name('admin.recursos.store')->middleware('auth');
Route::get('/admin/recursos/{id}', [App\Http\Controllers\RecursoController::class, 'show'])->name('admin.recursos.show')->middleware('auth');
Route::get('/admin/recursos/{id}/edit', [App\Http\Controllers\RecursoController::class, 'edit'])->name('admin.recursos.edit')->middleware('auth');
Route::put('/admin/recursos/{id}', [App\Http\Controllers\RecursoController::class, 'update'])->name('admin.recursos.update')->middleware('auth');
Route::get('/admin/recursos/{id}/confirm-delete', [App\Http\Controllers\RecursoController::class, 'confirmDelete'])->name('admin.recursos.confirmDelete')->middleware('auth');
Route::delete('/admin/recursos/{id}', [App\Http\Controllers\RecursoController::class, 'destroy'])->name('admin.recursos.destroy')->middleware('auth');

#Rutas para el admin-horarios y turnos
// 1. CONTROL DE ASISTENCIA (Círculo Naranja - Monitoreo de todos los trabajadores)
Route::get('/admin/horarios/control', [App\Http\Controllers\HorarioController::class, 'control'])->name('admin.horarios.control');
// 2. REGISTRO DE HORARIOS (Formulario para crear entradas)
Route::get('/admin/horarios/create', [App\Http\Controllers\HorarioController::class, 'create'])->name('admin.horarios.create');
Route::post('/admin/horarios', [App\Http\Controllers\HorarioController::class, 'store'])->name('admin.horarios.store');
// 3. LISTADO DE HORARIOS (Historial y reportes técnicos de registros pasados)
Route::get('/admin/horarios', [App\Http\Controllers\HorarioController::class, 'index'])->name('admin.horarios.index');
// 4. FUNCIONES ADICIONALES (Ver, Editar y Eliminar)
Route::get('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'show'])->name('admin.horarios.show');
Route::get('/admin/horarios/{id}/edit', [App\Http\Controllers\HorarioController::class, 'edit'])->name('admin.horarios.edit');
Route::put('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'update'])->name('admin.horarios.update');
Route::get('/admin/horarios/{id}/confirm-delete', [App\Http\Controllers\HorarioController::class, 'confirmDelete'])->name('admin.horarios.confirm-delete');
Route::delete('/admin/horarios/{id}', [App\Http\Controllers\HorarioController::class, 'destroy'])->name('admin.horarios.destroy');

#Rutas para el admin-produccion minera
Route::get('/admin/produccion', [App\Http\Controllers\ProduccionController::class, 'index'])->name('admin.produccion.index')->middleware('auth'); 
Route::get('/admin/produccion/create', [App\Http\Controllers\ProduccionController::class, 'create'])->name('admin.produccion.create')->middleware('auth'); 
Route::post('/admin/produccion/create', [App\Http\Controllers\ProduccionController::class, 'store'])->name('admin.produccion.store')->middleware('auth');
Route::get('/admin/produccion/{id}', [App\Http\Controllers\ProduccionController::class, 'show'])->name('admin.produccion.show')->middleware('auth');
Route::get('/admin/produccion/{id}/edit', [App\Http\Controllers\ProduccionController::class, 'edit'])->name('admin.produccion.edit')->middleware('auth');
Route::put('/admin/produccion/{id}', [App\Http\Controllers\ProduccionController::class, 'update'])->name('admin.produccion.update')->middleware('auth');
Route::get('/admin/produccion/{id}/confirm-delete', [App\Http\Controllers\ProduccionController::class, 'confirmDelete'])->name('admin.produccion.confirmDelete')->middleware('auth');
Route::delete('/admin/produccion/{id}', [App\Http\Controllers\ProduccionController::class, 'destroy'])->name('admin.produccion.destroy')->middleware('auth');

#Rutas para el admin-almacen e inventario
Route::get('/admin/almacen', [App\Http\Controllers\AlmacenController::class, 'index'])->name('admin.almacen.index')->middleware('auth'); 
Route::get('/admin/almacen/create', [App\Http\Controllers\AlmacenController::class, 'create'])->name('admin.almacen.create')->middleware('auth'); 
Route::post('/admin/almacen/create', [App\Http\Controllers\AlmacenController::class, 'store'])->name('admin.almacen.store')->middleware('auth');
Route::get('/admin/almacen/{id}', [App\Http\Controllers\AlmacenController::class, 'show'])->name('admin.almacen.show')->middleware('auth');
Route::get('/admin/almacen/{id}/edit', [App\Http\Controllers\AlmacenController::class, 'edit'])->name('admin.almacen.edit')->middleware('auth');
Route::put('/admin/almacen/{id}', [App\Http\Controllers\AlmacenController::class, 'update'])->name('admin.almacen.update')->middleware('auth');
Route::get('/admin/almacen/{id}/confirm-delete', [App\Http\Controllers\AlmacenController::class, 'confirmDelete'])->name('admin.almacen.confirmDelete')->middleware('auth');
Route::delete('/admin/almacen/{id}', [App\Http\Controllers\AlmacenController::class, 'destroy'])->name('admin.almacen.destroy')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
