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

Route::controller(TaskController::class)->group(function() {
    Route::get('/', 'index');
    Route::get('/create','create');
    Route::get('/create/{id?}','create');
    Route::post('/task-store','store');
    Route::get('/task-delete/{id?}','delete');
    Route::post('/task-status-change','task_status_change');
});
