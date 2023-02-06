<?php

use App\Http\Controllers\Api\ApiController;
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

Route::post('button', [ApiController::class, 'ButtonData']);
Route::post('video', [ApiController::class, 'VideoData']);
Route::post('apicall', [ApiController::class, 'ApiCallData']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
