<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;

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

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->prefix('users')->group(function() {
    Route::get('/', 'showAll');
    Route::get('/{id}', 'showById');
    Route::get('/nameHas/{key}', 'showByTitle');
    Route::put('/', 'add');
    Route::post('/{id}', 'update');
    Route::delete('/{id}', 'delete');

    Route::fallback(function () {return response('Endpoint not found', 404);});
});

Route::controller(VideoController::class)->prefix('videos')->group(function() {
    Route::get('/', 'showAll');
    Route::get('/{id}', 'showById');
    Route::get('/titleHas/{key}', 'showByTitle');
    Route::get('/tag/{tagId}', 'showByTag');
    Route::get('/titleHas/{key}/tag/{tagId}', 'showByTitleAndTag');
    Route::put('/', 'add');
    Route::post('/{id}', 'update');
    Route::delete('/{id}', 'delete');

    Route::fallback(function () {return response('Endpoint not found', 404);});
});