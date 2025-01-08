<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidateToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        $auth = true;

        if (!$token) {
            $auth = false;
        }

        $user = User::query()->where('token', $token)->first();
        if (!$user) {
            $auth = false;
        }

        if ($auth) {
            return $next($request);
        } else {
            return response()->json([
                'errors' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
} 