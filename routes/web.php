<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\HikeController;
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

Route::get('/', [HikeController::class, 'index'])->name('hikes.index');

Route::resource('hikes', HikeController::class)->middleware('auth');
Route::resource('groups', GroupController::class)->middleware('auth');
Route::get('/groups/{group}/join', [GroupController::class, 'join'])->name('groups.join');

Auth::routes();
