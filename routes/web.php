<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ContractedFormController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubContractorController;
use App\Http\Controllers\SupplierController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return view('admin-dashboard');
        })
            ->name('admin');



        Route::post('/login-to-user', [UsersController::class, 'login_to_user'])
            ->name('login_to_user');

        Route::post('/delete-user', [UsersController::class, 'delete_user'])
            ->name('delete_user');
    });





    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })
        // ->middleware('role:admin')
        ->name('dashboard');

    Route::get('/money', [MoneyController::class, 'index'])
        ->middleware('permission:view-money-page')
        ->name('money');

    Route::get('/project', [ProjectController::class, 'index'])
        ->middleware('permission:view-projects-page')
        ->name('project');

    Route::get('/sub-contractor', [SubContractorController::class, 'index'])
        ->middleware('permission:view-sub-contracts-page')
        ->name('sub-contractor');

    Route::get('/labor', [LaborController::class, 'index'])
        ->middleware('permission:view-labor-page')
        ->name('labor');

    Route::get('/bill', [BillController::class, 'index'])
        ->middleware('permission:view-bill-page')
        ->name('bill');

    Route::get('/supplier', [SupplierController::class, 'index'])
        ->middleware('permission:view-supplier-page')
        ->name('supplier');

    Route::get('/material', [MaterialController::class, 'index'])
        ->middleware('permission:view-material-page')
        ->name('material');

    Route::get('/contracted', [ContractedFormController::class, 'index'])
        ->middleware('permission:view-contracted-form')
        ->name('contracted');

    Route::get('/profile', [UsersController::class, 'profile'])
        ->name('profile');

    Route::post('/update-profile', [UsersController::class, 'update_profile'])->name('update_profile');
    Route::post('/change-password', [UsersController::class, 'change_password'])->name('change_password');
});

Route::get('/make-admin', function () {
    User::create([
        'name' => 'create admin',
        'email' => 'admin2@admin.com',
        'password' => Hash::make('admin2@admin.com')
    ])->assignRole('admin');
});

require __DIR__ . '/auth.php';