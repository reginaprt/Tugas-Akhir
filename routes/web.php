<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');


Route::middleware(['is_admin'])->group(function () {
    Route::get('admin/menus', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('admin/menus', [MenuController::class, 'create'])->name('admin.menu.create');
    Route::get('admin/ajaxadmin/dataMenu/{id}', [MenuController::class, 'dataMenu']);
    Route::patch('admin/menus/update/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::post('admin/menus/delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');
});
