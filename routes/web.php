<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\TripsController;
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
Route::get('/', [PagesController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/auth', [PagesController::class, 'auth']);
Route::get('/logout/auth', [PagesController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'isAdmin:0'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard']);
    Route::get('/dashboard/users', [UsersController::class, 'index']);
    Route::get('/users/add-user', [UsersController::class, 'create']);
    Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
    Route::put('/users/update/{id}', [UsersController::class, 'update']);
    Route::post('/users/store-user', [UsersController::class, 'store']);
    Route::delete('/users/delete/{id}', [UsersController::class, 'destroy']);

    Route::get('/dashboard/cities', [CitiesController::class, 'index']);
    Route::get('/cities/add-city', [CitiesController::class, 'create']);
    Route::get('/cities/get-province', [CitiesController::class, 'get_province']);
    Route::get('/cities/get-island', [CitiesController::class, 'get_island']);
    Route::get('/cities/get-lat', [CitiesController::class, 'get_lat']);
    Route::get('/cities/get-long', [CitiesController::class, 'get_long']);
    Route::post('/cities/store-city', [CitiesController::class, 'store']);
    Route::get('/cities/edit/{id}', [CitiesController::class, 'edit']);
    Route::put('/cities/update/{id}', [CitiesController::class, 'update']);
    Route::delete('/cities/delete/{id}', [CitiesController::class, 'destroy']);
    Route::get('/cities/find-coor/', [CitiesController::class, 'find_coor']);

    Route::get('/dashboard/trips', [TripsController::class, 'index']);
    Route::put('/perdin/selection/{id}', [TripsController::class, 'selection']);
    Route::get('/perdin/edit/{id}', [TripsController::class, 'edit']);
    Route::delete('/perdin/delete/{id}', [TripsController::class, 'destroy']);
});

Route::middleware(['auth', 'isAdmin:1'])->group(function () {
    Route::get('/perdinku', [TripsController::class, 'perdinku']);
    Route::get('/perdin/add-perdin', [TripsController::class, 'create']);
    Route::post('/perdin/store-perdin', [TripsController::class, 'store']);
    Route::delete('/perdin/delete/{id}', [TripsController::class, 'destroy']);
    Route::get('/perdin/detail/{id}', [TripsController::class, 'detail']);
});
// Route::middleware('auth')->group(function () {
//     Route::get('/cities/get-province', [CitiesController::class, 'get_province']);
//     Route::get('/cities/get-island', [CitiesController::class, 'get_island']);
//     Route::get('/cities/get-lat', [CitiesController::class, 'get_lat']);
//     Route::get('/cities/get-long', [CitiesController::class, 'get_long']);
// });