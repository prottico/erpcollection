<?php

use App\Http\Controllers\ClientsQuotationsController;
use App\Http\Controllers\CompanyClientController;
use App\Http\Controllers\IndependentClientController;
use App\Http\Controllers\LawyersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationsController;
use App\Models\Quotation;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['role:general-admin']], function () {

        // Lawyers
        Route::get('/abogados', [LawyersController::class, 'index'])->name('lawyers.index');
        Route::get('/abogados/nuevo', [LawyersController::class, 'create'])->name('lawyers.create');
        Route::get('/abogado/{token}', [LawyersController::class, 'show'])->name('lawyers.show');
        Route::patch('/abogados/nuevo', [LawyersController::class, 'store'])->name('lawyers.store');
        Route::delete('/abogados/{id}', [LawyersController::class, 'destroy'])->name('lawyers.destroy');
        Route::patch('/abogado/update/{lawyer}', [LawyersController::class, 'update'])->name('lawyers.update');

        // Independents Clients
        Route::get('/clientes/independientes', [IndependentClientController::class, 'index'])->name('independent.client.index');
        Route::get('/clientes/independientes/nuevo', [IndependentClientController::class, 'create'])->name('independent.client.create');
        Route::patch('/clientes/independientes/nuevo', [IndependentClientController::class, 'store'])->name('independent.client.store');
        Route::get('/cliente/independiente/{token}', [IndependentClientController::class, 'show'])->name('independent.client.show');
        Route::patch('/cliente/independiente/{client}', [IndependentClientController::class, 'update'])->name('independent.client.update');
        Route::delete('/cliente/independiente/{id}', [IndependentClientController::class, 'destroy'])->name('independent.client.destroy');

        // Company Clients
        Route::get('/clientes/empresas', [CompanyClientController::class, 'index'])->name('company.client.index');
        Route::get('/clientes/empresas/nuevo', [CompanyClientController::class, 'create'])->name('company.client.create');
        Route::patch('/clientes/empresas/nuevo', [CompanyClientController::class, 'store'])->name('company.client.store');

        // Quotations
        Route::get('/cotizaciones', [QuotationsController::class, 'index'])->name('quotations.index');
    });

    // Cotizaciones de Admin y Clientes
    Route::group(['middleware' => ['role:general-admin|independent-client']], function () {
        Route::get('/cotizaciones/nuevo', [QuotationsController::class, 'create'])->name('quotations.create');
        Route::get('/cotizaciones/{token}', [QuotationsController::class, 'show'])->name('quotations.show');
        Route::patch('/cotizaciones/nuevo', [QuotationsController::class, 'store'])->name('quotations.store');
    });

    // Cotizaciones por Clientes
    Route::group(['middleware' => ['role:independent-client']], function () {
        Route::get('/mis-cotizaciones', [ClientsQuotationsController::class, 'index'])->name('clients.quotations.index');
    });
});

require __DIR__ . '/auth.php';
