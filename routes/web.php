<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
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

// Route::get('/', function () {
//     return view('dashboard.index');
// });

Route::get('/dashboard/users', [UsersController::class, 'index']);
Route::get('/users/add-user', [UsersController::class, 'create']);
Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
Route::put('/users/update/{id}', [UsersController::class, 'update']);
Route::post('/users/store-user', [UsersController::class, 'store']);
Route::delete('/users/delete/{id}', [UsersController::class, 'destroy']);