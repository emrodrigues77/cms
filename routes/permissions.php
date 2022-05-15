<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');

    Route::get('/permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('/permissions/{permission}/destroy', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::patch('/permissions/{permission}/update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/permissions/create', [App\Http\Controllers\PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
});