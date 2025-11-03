<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenExpiry
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if ($token) {
            $personalToken = PersonalAccessToken::findToken($token);
            if ($personalToken && $personalToken->expires_at && $personalToken->expires_at->isPast()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token sudah kedaluwarsa.',
                ], 401);
            }
        }
        return $next($request);
    }
}
