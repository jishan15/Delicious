<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\SlideController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ReservationController;
use App\Http\Controllers\admin\ChefController;
use App\Http\Controllers\Admin\ItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/reservation', [App\Http\Controllers\HomeController::class, 'reserve'])->name('reservation.reserve');
Route::group(['prefix' =>'admin','middleware'=> 'auth'],function(){
    Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::resource('slider',SlideController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('item',ItemController::class);
    Route::get('/reservation',[ReservationController::class,'index'])->name('reservation.index');
    Route::post('/reservation/destroy/{id}',[ReservationController::class,'destroy'])->name('reservation.destroy');
    Route::post('/reservation/status/{id}',[ReservationController::class,'status'])->name('reservation.status');
    Route::resource('chef',ChefController::class);

});

Auth::routes();


