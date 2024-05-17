<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
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
