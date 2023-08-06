<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('/todolist', 'toDoList')->middleware('onlyMember');
    Route::post('/todolist', 'addToDoList')->middleware('onlyMember');
    Route::post('/todolist/delete/{id}', 'deleteToDoList')->middleware('onlyMember');
});

Route::view('/template', 'template');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware('onlyGuest');
    Route::post('/login', 'doLogin')->middleware('onlyGuest');
    Route::post('/logout', 'doLogout')->middleware('onlyMember');
});
