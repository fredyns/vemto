<?php

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

// mobile registration
Route::post('/registration', function (Request $request) {
    return (new CreateNewUser())->create($request->all());
});

// login
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
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

        // mobile logout API
        Route::post('logout', function (Request $request) {
            $bearerToken = $request->bearerToken();
            $segments = explode('|', $bearerToken);
            if ($request->user()->tokens()->where('id', $segments[0] ?? 0)->delete()) {
                return ['message' => "Logout success"];
            } else {
                return ['message' => "Logout failed"];
            }
        });

    });
