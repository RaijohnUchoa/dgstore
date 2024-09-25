<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('layouts.app');
});

Route::middleware('auth')->group(function () {
    Route::view('app', 'layouts.app')->name('app');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// USUÁRIOS
Route::get('/usersread', [AuthController::class, 'usersread'])->name('usersread');
Route::post('/userscreate', [AuthController::class, 'userscreate'])->name('userscreate');
Route::get('/usersedit/{id}', [AuthController::class, 'usersedit'])->name('usersedit');
Route::put('/usersupdate/{id}', [AuthController::class, 'usersupdate'])->name('usersupdate');
Route::get('/usersactive/{id}', [AuthController::class, 'usersactive'])->name('usersactive');
Route::get('/usersfilter/{id}', [AuthController::class, 'usersfilter'])->name('usersfilter');
// FORNECEDORES
Route::get('/suppliersread', [AuthController::class, 'suppliersread'])->name('suppliersread');
Route::post('/supplierscreate', [AuthController::class, 'supplierscreate'])->name('supplierscreate');
Route::get('/suppliersedit/{id}', [AuthController::class, 'suppliersedit'])->name('suppliersedit');
Route::put('/suppliersupdate/{id}', [AuthController::class, 'suppliersupdate'])->name('suppliersupdate');
Route::get('/suppliersdelete/{id}', [AuthController::class, 'suppliersdelete'])->name('suppliersdelete');

