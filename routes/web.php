<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\DenuncianteController;
use App\Http\Controllers\EvaluacionController;



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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta para el auditor
    Route::get('/auditor', [AuditorController::class, 'index'])->name('auditor.index');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/denunciante', [DenuncianteController::class, 'index'])->name('denunciante.index');
});

// Rutas para denuncias
Route::get("/Denuncias/Registro", [DenunciasController::class, "registro"]);
Route::post("/Denuncias/Guardar", [DenunciasController::class, "guardar"]);
Route::get('/denuncias/lista', [DenunciasController::class, 'index'])->name('denuncias.index');
Route::get("/Denuncias/modificar/{id}", [DenunciasController::class, "modificar"]);
Route::post("/Denuncias/Actualizar", [DenunciasController::class, "actualizar"]);
Route::delete("/Denuncias/eliminar/{id}", [DenunciasController::class, "eliminar"]);

// Rutas para auditores

Route::get('/Auditores/Registro', [AuditorController::class, 'registro']);
Route::post('/Auditores/Guardar', [AuditorController::class, 'guardar']);
Route::get('/Auditores/lista', [AuditorController::class, 'lista']);
Route::get('/Auditores/modificar/{id}', [AuditorController::class, 'modificar']);
Route::post('/Auditores/Actualizar', [AuditorController::class, 'actualizar']);
Route::delete('/Auditores/eliminar/{id}', [AuditorController::class, 'eliminar']);


// Rutas para evaluaciones


Route::get('/Evaluaciones/Registro', [EvaluacionController::class, 'registro']);
Route::post('/Evaluaciones/Guardar', [EvaluacionController::class, 'guardar']);
Route::get('/Evaluaciones/lista', [EvaluacionController::class, 'lista']);
Route::get('/Evaluaciones/modificar/{id}', [EvaluacionController::class, 'modificar']);
Route::post('/Evaluaciones/Actualizar', [EvaluacionController::class, 'actualizar']);
Route::delete('/Evaluaciones/eliminar/{id}', [EvaluacionController::class, 'eliminar']);