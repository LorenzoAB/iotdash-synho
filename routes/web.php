<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

#HOME

Route::prefix('home')->middleware(['auth'])->group(function () {
    # Usuario
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/user/profile', 'profile');
        Route::put('/user/profile/{user}', 'profile_update');
    });

    # Sensory
    Route::controller(App\Http\Controllers\Admin\SensoryController::class)->group(function () {
        Route::get('/sensory', 'index');
        Route::get('/sensory/create', 'create');
        Route::post('/sensory', 'store');
        Route::get('/sensory/list_ajax_sensory', 'list_ajax')->name('list_ajax_sensory');
    });

    # Graphic Sensory
    Route::controller(App\Http\Controllers\Admin\SensorygraphicController::class)->group(function () {
        Route::get('/sensory/graphic', 'index');
        Route::post('/sensory/list_ajax_sensory_graphic', 'list_graphic')->name('list_ajax_sensory_graphic');
    });

    # Report Sensory
    Route::controller(App\Http\Controllers\Admin\SensoryreportController::class)->group(function () {
        Route::get('/sensory/report', 'index');
        Route::post('/sensory/list_ajax_sensory_report', 'list_ajax')->name('list_ajax_sensory_report');
        Route::post('/sensory/list_ajax_sensory_report_graphic', 'list_graphic')->name('list_ajax_sensory_report_graphic');
        Route::post('/sensory/list_ajax_sensory_report_email', 'report_email')->name('list_ajax_sensory_report_email');
    });

    # Waterpump
    Route::controller(App\Http\Controllers\Admin\WaterpumpController::class)->group(function () {
        Route::get('/waterpump', 'index');
        Route::get('/waterpump/create', 'create');
        Route::post('/waterpump', 'store')->name('store_waterpump');
        Route::get('/waterpump/list_ajax_waterpump', 'list_ajax')->name('list_ajax_waterpump');
    });

    # Graphic waterpump
    Route::controller(App\Http\Controllers\Admin\waterpumpgraphicController::class)->group(function () {
        Route::get('/waterpump/graphic', 'index');
        Route::get('/waterpump/list_ajax_waterpump_graphic', 'list_graphic')->name('list_ajax_waterpump_graphic');
    });

    # Report waterpump
    Route::controller(App\Http\Controllers\Admin\waterpumpreportController::class)->group(function () {
        Route::get('/waterpump/report', 'index');
        Route::post('/waterpump/list_ajax_waterpump_report', 'list_ajax')->name('list_ajax_waterpump_report');
        Route::post('/waterpump/list_ajax_waterpump_report_graphic', 'list_graphic')->name('list_ajax_waterpump_report_graphic');
        Route::post('/waterpump/list_ajax_waterpump_report_email', 'report_email')->name('list_ajax_waterpump_report_email');
    });
});


# ADMIN
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    # Usuario
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/create', 'create');
        Route::post('/user', 'store');
        Route::get('/user/{user}/show', 'show');
        Route::get('/user/{user}/edit', 'edit');
        Route::post('/user/delete', 'destroy')->name('destroy_user');
        Route::put('/user/{user}', 'update');
        Route::get('/user/list_ajax_user', 'list_ajax')->name('list_ajax_user');
    });
});