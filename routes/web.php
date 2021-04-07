<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/new', [App\Http\Controllers\ProjectController::class, 'index'])->name('new');
Route::post('/new', [App\Http\Controllers\ProjectController::class, 'store'])->name('create');
Route::get('/edit/{project?}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('edit');
Route::patch('/edit/{project?}', [App\Http\Controllers\ProjectController::class, 'update'])->name('update');