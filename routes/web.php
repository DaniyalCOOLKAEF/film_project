<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/films', ['App\Http\Controllers\FilmController', 'index'])->name('film.index');
Route::get('/films/create', ['App\Http\Controllers\FilmController', 'create'])->name('film.create');
Route::post('/films/store', ['App\Http\Controllers\FilmController', 'store'])->name('film.store');
Route::get('/films/{film}', ['App\Http\Controllers\FilmController', 'show'])->name('film.show');
Route::get('/films/{film}/edit', ['App\Http\Controllers\FilmController', 'edit'])->name('film.edit');
Route::patch('/films/{film}', ['App\Http\Controllers\FilmController', 'update'])->name('film.update');


