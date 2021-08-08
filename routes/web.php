<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


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

Route::post('/add', [TaskController::class, 'create'])->name('addtask');
Route::put('/change', [TaskController::class, 'update'])->middleware('auth');
Route::put('/changedone', [TaskController::class, 'edit'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/changetasktekst', [TaskController::class, 'changetekst'])->middleware('auth')->name('changetekst');
Route::get('/changetask/{id}', [TaskController::class, 'getOne'])->middleware('auth')->name('changetask');
Route::post('/addhome', [App\Http\Controllers\HomeController::class, 'create'])->middleware('auth')->name('addtaskhome');

Route::get('/', [TaskController::class, 'index'])->name('mainpage');



