<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {

    Route::resource('dashboard',DashboardController::class);




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::group(['middleware' => ['role:super-admin|admin']], function() {
    
    //     Route::resource('permissions', PermissionController::class);
    //     Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);
    
    //     Route::resource('roles', RoleController::class);
    //     Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    //     Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    //     Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);
    
    //     Route::get('users/{userId}/delete', [UserController::class, 'destroy']);
        
        
    // });
     // --------------------> User <--------------------
    Route::resource('user', UserController::class);

    // --------------------> customers <--------------------
    Route::resource('customer', CustomerController::class)->except(['show', 'edit', 'create']);
    // --------------------> Supplier <--------------------
    Route::resource('supplier', SupplierController::class)->except(['show', 'edit', 'create']);
    // --------------------> Category <--------------------
    Route::resource('category', CategoryController::class)->except(['show', 'edit', 'create']);
    // --------------------> Brand <--------------------
    Route::resource('brand', BrandController::class)->except(['show', 'edit', 'create']);


});

require __DIR__.'/auth.php';
