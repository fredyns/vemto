<?php

use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
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

        Route::apiResource('users', UserController::class);
    });
