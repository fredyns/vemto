<?php

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

// default
Route::redirect('/', '/api/user');

// login
Route::post('login', function (Request $request) {
    if ($request->user('sanctum')) return ['message' => "Already logged in."];

    return (new AuthController())->login($request);
});

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

        // mobile registration
        Route::post('/registration', function (Request $request) {
            if ($request->user()) return ['message' => "Registration only allowed for guest."];

            return (new CreateNewUser())->create($request->all());
        });

        // current user
        Route::get('user', function (Request $request) {
            return $request->user();
        })->name('user');

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

//// tes
//Route::get('tes', function (Request $request) {
//    return $request->user('sanctum');
//});
