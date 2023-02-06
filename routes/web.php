<?php

use App\Http\Controllers\ApiCallController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeshboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ButtonController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\AutoCompleter;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('index');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Deshboard
    Route::get('/', [DeshboardController::class, 'index'])->name('index');
    Route::get('/dashboard', [DeshboardController::class, 'index'])->name('dashboard');

    // App Setting
    Route::get('/appsetting', [SettingController::class, 'index'])->name('appsetting');
    Route::get('/Get_AppSettingData', [SettingController::class, 'Get_AppSettingData'])->name('Get_AppSettingData');
    Route::post('/Add_Edit_AppSettingData', [SettingController::class, 'Add_Edit_AppSettingData'])->name('Add_Edit_AppSettingData');
    Route::get('/Edit_AppSettingData/{id}', [SettingController::class, 'Edit_AppSettingData'])->name('Edit_AppSettingData');
    Route::post('/Delete_AppSettingData', [SettingController::class, 'Delete_AppSettingData'])->name('Delete_AppSettingData');

    // Button
    Route::get('/button', [ButtonController::class, 'index'])->name('button');
    Route::get('/Get_ButtonData', [ButtonController::class, 'Get_ButtonData'])->name('Get_ButtonData');
    Route::post('/Add_Edit_ButtonData', [ButtonController::class, 'Add_Edit_ButtonData'])->name('Add_Edit_ButtonData');
    Route::get('/Edit_ButtonData/{id}', [ButtonController::class, 'Edit_ButtonData'])->name('Edit_ButtonData');
    Route::post('/Delete_ButtonData', [ButtonController::class, 'Delete_ButtonData'])->name('Delete_ButtonData');

    // Video
    Route::get('/video', [VideoController::class, 'index'])->name('video');
    Route::get('/Get_VideoData', [VideoController::class, 'Get_VideoData'])->name('Get_VideoData');

    // API CALL
    Route::get('/apicall', [ApiCallController::class, 'index'])->name('apicall');
    Route::get('/Get_ApiCallData', [ApiCallController::class, 'Get_ApiCallData'])->name('Get_ApiCallData');
});
