<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Userontroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();
Route::get('add', [AdminController::class, 'create'])->name('admin.create');
Route::post('store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
// Route::get('/supplier', [AdminController::class, 'supplier'])->name('admin.sup');
Route::post('update/{id}', [AdminController::class,'update'])->name('admin.update');
Route::get('delete/{id}', [AdminController::class,'delete'])->name('admin.delete');
Route::post('soft/{id}', [AdminController::class, 'soft'])->name('admin.soft');

Route::get('/supplier', [SupController::class, 'index'])->name('sup.index');
Route::get('/supplier/add', [SupController::class, 'create'])->name('sup.create');
Route::post('/supplier/store', [SupController::class, 'store'])->name('sup.store');
Route::get('/supplier/edit/{id}', [SupController::class, 'edit'])->name('sup.edit');
Route::post('/supplier/update/{id}', [SupController::class,'update'])->name('sup.update');
Route::get('/supplier/delete/{id}', [SupController::class,'delete'])->name('sup.delete');
Route::post('/supplier/soft/{id}', [SupController::class, 'soft'])->name('sup.soft');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', [LoginController::class, 'login'])->name('login');
// Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
