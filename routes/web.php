<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TodoListController;

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

// Route::resource('tasks', TodoListController::class);

Route::prefix('tasks')
->controller(TodoListController::class)
->name('tasks.')
->group(function(){
    Route::get("/", "index")->name('index');
    Route::post("/", "store")->name('store');
    Route::get("/{task}/edit", "edit")->name('edit');
    Route::post("/{task}/edit", "update")->name('update');
    Route::get("/{task}/destroy", "destroy")->name('destroy');
    Route::get("/{task}", "completion")->name('completion');
});
