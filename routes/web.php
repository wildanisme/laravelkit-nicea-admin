<?php

use App\Http\Controllers\DBBackupController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::permanentRedirect('/', '/login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('profil', ProfilController::class)->except('destroy');

// Route::resource('manage-user', UserController::class);
Route::controller(UserController::class)->name('manage-user.')->group(function () {
    Route::get('manage-user', 'index')->name('index');
    Route::get('manage-user/create', 'create')->name('create');
    Route::post('manage-user', 'store')->name('store');
    Route::get('manage-user/{id}', 'show')->name('show');
    Route::get('manage-user/{id}/edit', 'edit')->name('edit');
    Route::put('manage-user/{id}', 'update')->name('update');
    Route::delete('manage-user/{id}/delete', 'destroy')->name('destroy');
});
Route::resource('manage-role', RoleController::class);
Route::resource('manage-menu', MenuController::class);
Route::resource('manage-permission', PermissionController::class)->only('store', 'destroy');


Route::get('dbbackup', [DBBackupController::class, 'DBBackup']);
