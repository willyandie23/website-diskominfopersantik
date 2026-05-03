<?php

use App\Http\Controllers\API\AppLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Route::resource('app-logs', AppLogController::class, ['only' => ['index', 'show']]);
