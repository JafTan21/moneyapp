<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubContractorController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::redirect('/', '/dashboard');

    Route::get('/money', [MoneyController::class, 'index'])->name('money');
    Route::get('/project', [ProjectController::class, 'index'])->name('project');
    Route::get('/sub-contractor', [SubContractorController::class, 'index'])->name('sub-contractor');
    Route::get('/labor', [LaborController::class, 'index'])->name('labor');
    Route::get('/bill', [BillController::class, 'index'])->name('bill');
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');

    //  to do
    // Route::get('/material', [MaterialController::class, 'index'])->name('material');
});


require __DIR__ . '/auth.php';