<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RecordController;
use App\Http\Controllers\Api\SubrecordController;
use App\Http\Controllers\Api\UserUploadController;
use App\Http\Controllers\Api\UserRecordsController;
use App\Http\Controllers\Api\UserGalleryController;
use App\Http\Controllers\Api\UserUserUploadsController;
use App\Http\Controllers\Api\UserActivityLogController;
use App\Http\Controllers\Api\RecordSubrecordsController;
use App\Http\Controllers\Api\UserUserGalleriesController;
use App\Http\Controllers\Api\UserUserActivityLogsController;

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

// status
Route::any('/', [AuthController::class, 'status'])->name('api.status');

// login
Route::post('login', [AuthController::class, 'login'])->name('api.login');

// registration
Route::post('registration', [AuthController::class, 'registration'])->name(
    'api.registration'
);

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        // current user
        Route::get('user', fn(Request $req) => ['data' => $req->user()])->name('user');

        // logout
        Route::post('logout', [AuthController::class, 'logout'])->name(
            'logout'
        );

        Route::apiResource('users', UserController::class);

        Route::apiResource(
            'user-activity-logs',
            UserActivityLogController::class
        );

        Route::apiResource('records', RecordController::class);

        // Record Subrecords
        Route::get('/records/{record}/subrecords', [
            RecordSubrecordsController::class,
            'index',
        ])->name('records.subrecords.index');
        Route::post('/records/{record}/subrecords', [
            RecordSubrecordsController::class,
            'store',
        ])->name('records.subrecords.store');

        Route::apiResource('user-uploads', UserUploadController::class);

        Route::apiResource('user-galleries', UserGalleryController::class);

        Route::apiResource('subrecords', SubrecordController::class);
    });
