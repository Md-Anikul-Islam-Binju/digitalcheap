<?php

use App\Http\Controllers\api\AboutController;
use App\Http\Controllers\api\NewsController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\SliderController;
use App\Http\Controllers\api\TeamController;
use App\Http\Controllers\api\TrainingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


