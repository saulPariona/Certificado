<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\Admin\AdminMiddleware;

Route::get('/', [LoginController::class, 'getLogin'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', [AdminController::class, 'getDashboard'])->name('dashboard');
        Route::get('/add-evento', [AdminController::class, 'getAddEvent'])->name('add-evento'); // el name es para que se pueda acceder a la ruta, usar en el metodo get 
        Route::post('/add-evento', [AdminController::class, 'postAddEvent']);
        Route::prefix('evento/{evento_id}')->group(function () {
            Route::get('/', [AdminController::class, 'evento'])->name('evento'); // eventos con los roles de organizador, ponente, asistente y pre registrado
            Route::get('/add-certificado-base', [AdminController::class, 'getAddCertificadoBase'])->name('add-certificado-base'); // agregar certificado base
            Route::post('/add-certificado-base', [AdminController::class, 'postAddCertificadoBase']);
            Route::get('/add-organizador', [AdminController::class, 'getAddOrganizador'])->name('add-organizador'); // agregar organizador
            Route::post('/add-organizador', [AdminController::class, 'postAddOrganizador']);
            Route::get('/add-ponente', [AdminController::class, 'getAddPonente'])->name('add-ponente'); // agregar ponentes
            Route::post('/add-ponente', [AdminController::class, 'postAddPonente']);
            Route::get('/certificados', [AdminController::class, 'certificados'])->name('admin-certificados'); // certificados
            Route::get('/certificados/organizadores', [AdminController::class, 'generarCertificadoOrganizadores'])->name('generar-organizadores');
            Route::get('/certificados/ponentes', [AdminController::class, 'generarCertificadoPonentes'])->name('generar-ponentes');
            Route::get('/certificados/organizadores/desacertificar', [AdminController::class, 'desacertificarOrganizadores'])->name('desacertificar-organizadores');
            Route::get('/certificados/ponentes/desacertificar', [AdminController::class, 'desacertificarPonentes'])->name('desacertificar-ponentes');
            //rutas de asistentes para generar certificados y desacertificar
            Route::get('/certificados/asistentes', [AdminController::class, 'generarCertificadoAsistentes'])->name('generar-asistentes');
            Route::get('/certificados/asistentes/desacertificar', [AdminController::class, 'desacertificarAsistentes'])->name('desacertificar-asistentes');
            //rutas de asistente
            Route::get('/add-asistente', [AdminController::class, 'getAddAsistente'])->name('add-asistente'); // agregar asistente
            Route::post('/add-asistente', [AdminController::class, 'postAddAsistente']);
            //rutas de exportar
            Route::get('/exportar-organizadores', [AdminController::class, 'exportOrganizadores'])->name('exportar-organizadores');
            Route::get('/exportar-ponentes', [AdminController::class, 'exportPonentes'])->name('exportar-ponentes');
            Route::get('/exportar-asistentes', [AdminController::class, 'exportAsistentes'])->name('exportar-asistentes');
        });
    });
});
Route::get('/certificado/{certificado_id}', [AdminController::class, 'documento'])->name('documento');
