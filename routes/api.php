<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Waterpump
Route::controller(App\Http\Controllers\Admin\WaterpumpController::class)->group(function () {
    Route::post('/waterpump/save_ajax_waterpump', 'save_ajax_waterpump')->name('save_ajax_waterpump');
    Route::get('/waterpump/list_ajax_waterpump', 'list_ajax_waterpump')->name('list_ajax_waterpump');
    Route::get('/waterpump/list_ajax_waterpump_graphic', 'list_ajax_waterpump_graphic')->name('list_ajax_waterpump_graphic');
});

# Sensory
Route::controller(App\Http\Controllers\Admin\SensoryController::class)->group(function () {
    Route::post('/sensory/save_ajax_sensory', 'save_ajax_sensory')->name('save_ajax_sensory');
    Route::get('/sensory/list_ajax_sensory/', 'list_ajax_sensory')->name('list_ajax_sensory');
    
});
