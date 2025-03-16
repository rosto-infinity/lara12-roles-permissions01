<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

Route::group(['middleware'=> ['role:super-admin|admin']], function () {
    // role:super-admin|admin
    //auth
    //resources pour roles; permissions
        Route::resource('permissions',  PermissionController::class);
        Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);
        
        
        //resources pour roles; permissions
        Route::resource('roles',  RoleController::class);
        Route::get('roles/{roleId}/delete',  [RoleController::class, 'destroy']);
        // ->middleware('permission:delete role');
        
        Route::get('roles/{roleId}/give-permissions',   [RoleController::class, 'addPermissionToRole'])->name('roles.addPermissionToRole');
        Route::put('roles/{roleId}/give-permissions',   [RoleController::class, 'givePermissionToRole'])->name('give.addPermissionToRole');
        
        //resources pour users
        Route::resource('users',  UserController::class);
        //route pour delete user
        Route::get('users/{user}/delete',  [UserController::class, 'destroy'])->name('users.destroy');
       
});

Route::get('/', function () {
    
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';