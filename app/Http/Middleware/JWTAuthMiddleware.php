<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) throw new Exception('User Not Found');
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                        'data' => null,
                        'status' => false,
                        'err_' => [
                            'message' => 'Token Invalid',
                            'code' => 1
                        ]
                    ]
                );
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                        'data' => null,
                        'status' => false,
                        'err_' => [
                            'message' => 'Token Expired',
                            'code' => 1
                        ]
                    ]
                );
            } else {
                if ($e->getMessage() === 'User Not Found') {
                    return response()->json([
                            "data" => null,
                            "status" => false,
                            "err_" => [
                                "message" => "User Not Found",
                                "code" => 1
                            ]
                        ]
                    );
                }
                return response()->json([
                        'data' => null,
                        'status' => false,
                        'err_' => [
                            'message' => 'Authorization Token not found',
                            'code' => 1
                        ]
                    ]
                );
            }
        }
        return $next($request);
    }
}
