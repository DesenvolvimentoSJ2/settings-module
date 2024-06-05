<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\MenuController;
use Modules\Settings\Http\Controllers\ModulesController;
use Modules\Settings\Http\Controllers\UsersController;

Route::prefix('settings')->group(function() {
    // Route::resource('')
    Route::resource('/modules', ModulesController::class);

    Route::resource('/users', UsersController::class);

    Route::resource('/menu', MenuController::class);
});
