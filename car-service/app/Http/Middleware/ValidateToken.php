<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ValidateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        $response = Http::withToken($token)->get(config('app.services.auth.domain') . '/validate');

        if ($response->failed()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->merge(['user_id' => $response->json()['id']]);

        return $next($request);
    }
}
