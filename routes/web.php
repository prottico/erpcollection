<?php

use App\Models\Quotation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LawyersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationsController;
use App\Http\Controllers\CompanyClientController;
use App\Http\Controllers\ClientsCompanyController;
use App\Http\Controllers\ClientsQuotationsController;
use App\Http\Controllers\IndependentClientController;
use App\Http\Controllers\LawyersQuotationsController;

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
    // return view('welcome');
    // return redirect()->route('login');
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => ['role:general-admin']], function () {

        // Admin Creacion de Abogados
        Route::get('/admin/abogados', [LawyersController::class, 'index'])->name('lawyers.index');
        Route::get('/admin/abogados/nuevo', [LawyersController::class, 'create'])->name('lawyers.create');
        Route::get('/admin/abogado/{token}', [LawyersController::class, 'show'])->name('lawyers.show');
        Route::patch('/admin/abogados/nuevo', [LawyersController::class, 'store'])->name('lawyers.store');
        Route::delete('/admin/abogados/{id}', [LawyersController::class, 'destroy'])->name('lawyers.destroy');
        Route::patch('/admin/abogado/update/{lawyer}', [LawyersController::class, 'update'])->name('lawyers.update');

        // Admin Creacion de Independientes
        Route::get('/admin/clientes/independientes', [IndependentClientController::class, 'index'])->name('independent.client.index');
        Route::get('/admin/clientes/independientes/nuevo', [IndependentClientController::class, 'create'])->name('independent.client.create');
        Route::patch('/admin/clientes/independientes/nuevo', [IndependentClientController::class, 'store'])->name('independent.client.store');
        Route::get('/admin/cliente/independiente/{token}', [IndependentClientController::class, 'show'])->name('independent.client.show');
        Route::patch('/admin/cliente/independiente/{client}', [IndependentClientController::class, 'update'])->name('independent.client.update');
        Route::delete('/admin/cliente/independiente/{id}', [IndependentClientController::class, 'destroy'])->name('independent.client.destroy');

        // Admin Creacion de Empresas
        Route::get('/admin/clientes/empresas', [CompanyClientController::class, 'index'])->name('company.client.index');
        Route::get('/admin/clientes/empresas/nuevo', [CompanyClientController::class, 'create'])->name('company.client.create');
        Route::patch('/admin/clientes/empresas/nuevo', [CompanyClientController::class, 'store'])->name('company.client.store');
        Route::get('/admin/cliente/empresa/{token}', [CompanyClientController::class, 'show'])->name('company.client.show');
        Route::patch('/admin/cliente/empresa/{client}', [CompanyClientController::class, 'update'])->name('company.client.update');
        Route::delete('/admin/cliente/empresa/{id}', [CompanyClientController::class, 'destroy'])->name('company.client.destroy');

        // Admin Cotizaciones
        Route::get('/cotizaciones', [QuotationsController::class, 'index'])->name('quotations.index');
        Route::post('/admin/asignar-abogado', [QuotationsController::class, 'assignLawyer'])->name('quotations.assign.lawyer');
        Route::delete('/cotizaciones/{id}', [QuotationsController::class, 'destroy'])->name('quotations.destroy');

        // Admin Creacion de Usuarios
        Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/usuarios/nuevo', [UserController::class, 'create'])->name('admin.users.create');
        Route::patch('/admin/usuarios/nuevo', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/admin/usuario/{token}', [UserController::class, 'show'])->name('admin.users.show');
        Route::patch('/admin/usuario/{token}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/admin/usuario/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    });

    // Cotizaciones de Admin y Clientes
    Route::group(['middleware' => ['role:general-admin|independent-client|company-client|employee']], function () {
        Route::get('/cotizaciones/nuevo', [QuotationsController::class, 'create'])->name('quotations.create');
        Route::patch('/cotizaciones/nuevo', [QuotationsController::class, 'store'])->name('quotations.store');
        Route::get('/cotizacion/editar/{token}', [QuotationsController::class, 'edit'])->name('quotations.edit');
        Route::get('/cotizaciones/{token}', [QuotationsController::class, 'show'])->name('quotations.show');
        Route::patch('/cotizaciones/update/{token}', [QuotationsController::class, 'updateQuotationByAdmin'])->name('quotations.update');

        Route::get('/report-budget/{token}', [ReportController::class, 'pdfQuotationBudgetGenerate'])->name('report.quotation.budget');
    });

    // Cotizaciones para abogados
    Route::group(['middleware' => ['role:lawyer']], function () {
        Route::get('/cotizaciones-asignadas', [LawyersQuotationsController::class, 'index'])->name('lawyers.quotations.index');
        Route::get('/cotizaciones-asignadas/{token}', [QuotationsController::class, 'show'])->name('lawyers.quotations.show');
        // Route::patch('/cotizaciones-asignadas/{token}', [QuotationsController::class, 'update'])->name('lawyers.quotations.update');
    });

    // Cotizaciones por Clientes
    Route::group(['middleware' => ['role:independent-client|company-client|employee']], function () {
        Route::get('/mis-cotizaciones', [ClientsQuotationsController::class, 'index'])->name('clients.quotations.index');
    });

    // Cotizaciones por Clientes
    Route::group(['middleware' => ['role:company-client']], function () {
        Route::get('/usuarios', [ClientsCompanyController::class, 'index'])->name('clients.company.users.index');
        Route::get('/usuarios/nuevo', [ClientsCompanyController::class, 'create'])->name('clients.company.users.create');
        Route::patch('/usuarios/nuevo', [ClientsCompanyController::class, 'store'])->name('clients.company.users.store');
        Route::get('/usuarios/{token}', [ClientsCompanyController::class, 'show'])->name('clients.company.users.show');
        Route::patch('/usuarios/{token}', [ClientsCompanyController::class, 'update'])->name('clients.company.users.update');
    });
});

require __DIR__ . '/auth.php';
