<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $user = User::whereEmail($request->email)->firstOrFail();

        $token = $user->createToken('auth-token');

        return response()->json([
            'token' => $token->plainTextToken,
        ]);
    }

    public function status(Request $request)
    {
        $user = $request->user('sanctum');
        $menus = [];
        $links = [];

        if (Gate::forUser($user)->allows('view-any', User::class)) {
            $menus['users'] = [
                "label" => "Users",
                "url" => route('api.users.index'),
            ];
        }

        if ($user) {
            $links['profile'] = [
                "label" => "Profile",
                "url" => route('api.user'),
            ];
            $links['logout'] = [
                "label" => "Logout",
                "url" => route('api.logout'),
            ];
        } else {
            $links['login'] = [
                "label" => "Login",
                "url" => route('api.login'),
            ];
        }

        return [
            'message' => $user ? "Authenticated." : "Unauthenticated.",
            'user' => $user,
            'menus' => $menus,
            'links' => $links,
        ];
    }

}
