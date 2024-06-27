<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BbiController;
use App\Http\Controllers\RekomenController;
use App\Http\Controllers\HasilController;

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

Route::redirect('/', '/login');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('admin/home', [AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');


Route::middleware(['is_admin'])->group(function () {

    // Menu ------------------------------------------------------------------------------------------------------------
    Route::get('admin/menus', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('admin/menus', [MenuController::class, 'create'])->name('admin.menu.create');
    Route::get('admin/ajaxadmin/dataMenu/{id}', [MenuController::class, 'dataMenu']);
    Route::patch('admin/menus/update', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::post('admin/menus/delete/{id}', [MenuController::class, 'delete'])->name('admin.menu.delete');
});


Route::middleware(['auth'])->group(function () {

    // Bbi -------------------------------------------------------------------------------------------------------------
    Route::get('user/bbis', [BbiController::class, 'index'])->name('user.bbi');
    Route::post('user/bbis', [BbiController::class, 'create'])->name('user.bbi.create');
    Route::get('user/ajaxuser/dataBbi/{id}', [BbiController::class, 'dataBbi']);
    Route::patch('user/bbis/update', [BbiController::class, 'update'])->name('user.bbi.update');
    Route::post('user/bbis/delete/{id}', [BbiController::class, 'delete'])->name('user.bbi.delete');

    // Rekomendasi Menu ------------------------------------------------------------------------------------------------
    Route::get('user/rekomendasi', [RekomenController::class, 'index'])->name('user.rekomen');
    Route::get('user/rekomendasi/check', [RekomenController::class, 'check'])->name('user.rekomen.check');
    Route::get('user/ajaxuser/dataRekomen/{id}', [RekomenController::class, 'dataRekomen']);

    // Hasil Akhir -----------------------------------------------------------------------------------------------------
    Route::get('user/hasil', [HasilController::class, 'index'])->name('user.rekomen');
    Route::get('user/print-hasil', [HasilController::class,'print_hasil'])->name('user.print.hasil');

});
