<?php

use App\Http\Controllers\Main\PermissionController;
use App\Http\Controllers\Main\RoleController;
use App\Http\Controllers\Main\YearController;
use App\Http\Controllers\MainYearController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::middleware('auth')->group(function() {

           Route::middleware('role:admin')->group(function() {
                Route::get('/give-role-permission/{role}', [RoleController::class, 'givePermission'])->name('roles.give_permission');
                Route::post('/give-role-permission/{role}', [RoleController::class, 'storeGivePermission'])->name('roles.store_give_permission');
                Route::delete('roles/{role}/permission/{permission}', [RoleController::class, 'removePermission'])->name('roles.remove_permission');
                Route::resource('/roles', RoleController::class);
                Route::resource('/permissions', PermissionController::class);
           });

            // Route role admin
           Route::middleware('role:admin')->group(function() {

            // Route Years
            Route::prefix('/years')->name('years.')->group(function() {
                Route::get('/', [YearController::class, 'index'])->name('index');
            });

           });
            
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});
