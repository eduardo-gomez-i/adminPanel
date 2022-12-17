<?php

use App\Exports\EtiquetasExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/downloadYearInfo', [App\Http\Controllers\HomeController::class, 'downloadYearInfo'])->name('downloadYearInfo');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');

    Route::post('/PersonasDia', [App\Http\Controllers\HomeController::class, 'PersonasDia'])->name('PersonasDia');


    Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::resource('impresoras', App\Http\Controllers\ImpresoraController::class);
    Route::resource('documentos', App\Http\Controllers\DocumentoController::class);

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::post('/nuevosProductosExport', [App\Http\Controllers\NuevosProductosController::class, 'exportar'])->name('nuevos.exportar');
    Route::get('/nuevosProductos', [App\Http\Controllers\NuevosProductosController::class, 'index'])->name('nuevos.index');
    Route::get('/excel', function () {
        return Excel::download(new EtiquetasExport, 'products.xlsx');
    })->name('excel');

    Route::get('/comisionesV', [App\Http\Controllers\ComisionesController::class, 'vendedores'])->name('comisionesV');

    Route::get('/incentivos', [App\Http\Controllers\IncentivosController::class, 'index'])->name('incentivos.index');
    Route::get('/almacen', [App\Http\Controllers\AlmacenController::class, 'index'])->name('almacen');
    Route::get('/almacenistas', [App\Http\Controllers\AlmacenController::class, 'registroAlmacen'])->name('registroAlmacen');
    Route::get('/almacenistasBusqueda', [App\Http\Controllers\AlmacenController::class, 'busquedaAlmacen'])->name('busquedaAlmacen');
    Route::post('/almacenistasReg', [App\Http\Controllers\AlmacenController::class, 'registroAlmacenPost'])->name('registroAlmacenPost');
    Route::get('/ventas', [App\Http\Controllers\VentasController::class, 'index'])->name('ventas');

    Route::prefix('cajas')->group(function () {
        Route::get('/index', [App\Http\Controllers\CajasController::class, 'index'])->name('cajas.index');
        Route::get('/remisionesEfectivo', [App\Http\Controllers\CajasController::class, 'getEfectivoRemisiones'])->name('cajas.efectivoRemisiones');
        Route::get('/facturasEfectivo', [App\Http\Controllers\CajasController::class, 'getEfectivoFacturas'])->name('cajas.efectivoFacturas');
        Route::get('/credito', [App\Http\Controllers\CajasController::class, 'getCredito'])->name('cajas.credito');
        Route::get('/tarjetas', [App\Http\Controllers\CajasController::class, 'getTarjetas'])->name('cajas.tarjetas');
        Route::get('/cheques', [App\Http\Controllers\CajasController::class, 'getCheques'])->name('cajas.cheques');
        Route::get('/infonavit', [App\Http\Controllers\CajasController::class, 'getInfonavit'])->name('cajas.infonavit');
        Route::get('/cancelados', [App\Http\Controllers\CajasController::class, 'getCancelados'])->name('cajas.cancelados');
        Route::get('/depositos', [App\Http\Controllers\CajasController::class, 'getDepositos'])->name('cajas.depositos');
        Route::get('/conekta', [App\Http\Controllers\CajasController::class, 'getConekta'])->name('cajas.conekta');
        Route::get('/link', [App\Http\Controllers\CajasController::class, 'getLink'])->name('cajas.link');
    });

});