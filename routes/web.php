<?php

use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');
Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('user');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.index');

    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::delete('/admin/posts/{post}/destroy', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::patch('/admin/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');

    Route::get('/admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
    Route::patch('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
    Route::get('/admin/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::delete('/admin/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/admin/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/admin/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detach'])->name('user.role.detach');
    Route::get('/admin/users/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});

Route::middleware('role')->group(function () {
});