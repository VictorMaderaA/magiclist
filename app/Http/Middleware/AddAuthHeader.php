<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Namshi\JOSE\Base64\Base64Encoder;
use Symfony\Component\ErrorHandler\Debug;
use Tymon\JWTAuth\Facades\JWTAuth;

class AddAuthHeader
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->bearerToken()) {
            if ($request->hasCookie('_token')) {
                $token = Crypt::decrypt(Cookie::get('_token'), true);
                $request->headers->add(['Authorization' => 'Bearer ' . $token]);

            }
        }
        return $next($request);
    }
}
