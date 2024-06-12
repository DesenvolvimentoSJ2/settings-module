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
use Modules\Settings\Http\Controllers\PermissionsController;
use Modules\Settings\Http\Controllers\RolesController;
use Modules\Settings\Http\Controllers\UserModulesController;
use Modules\Settings\Http\Controllers\UsersController;

Route::prefix('settings')->middleware(['auth', 'menu'])->group(function() {
    // Route::resource('/modules', ModulesController::class)->middleware('checkPermission');
    Route::resource('/modules', ModulesController::class);

    Route::resource('/users', UsersController::class);

    Route::resource('/menu', MenuController::class);

    Route::resource('/roles', RolesController::class);

    Route::resource('/permissions', PermissionsController::class);

    Route::delete('/userModules/{user}', [UserModulesController::class, 'remove'])->name('userModules.remove');

    // Route::resource('/userModules', UserModulesController::class);
});


/*
Route::prefix('settings')->middleware(['auth', 'checkPermission'])->group(function() {

    Route::resource('/modules', ModulesController::class);

    Route::resource('/users', UsersController::class);

    Route::resource('/menu', MenuController::class);

    Route::resource('/roles', RolesController::class);

    Route::resource('/permissions', PermissionsController::class);
});
*/

