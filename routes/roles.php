<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::patch('/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');

    Route::put('/roles/{role}/attach', [App\Http\Controllers\RoleController::class, 'permissionAttach'])->name('role.permission.attach');
    Route::put('/roles/{role}/detach', [App\Http\Controllers\RoleController::class, 'permissionDetach'])->name('role.permission.detach');
});