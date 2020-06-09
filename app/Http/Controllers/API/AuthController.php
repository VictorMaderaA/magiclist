<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Base\BaseController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $response = response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
        if (request('cookie', false)) {
            $cookie = $this->getCookieDetails($token);
            $val = Crypt::encrypt($cookie['value'], true);
            Log::debug($val, [1]);
            $response->headers->setCookie(\cookie($cookie['name'], $val, $cookie['minutes'], $cookie['path'],
                $cookie['domain'], $cookie['secure'], $cookie['httponly'], true));
        }
        return $response;
    }

    /**
     * @param $token
     * @return array
     */
    private function getCookieDetails($token)
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => auth()->factory()->getTTL() * 60,
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => (app()->environment('app.env') === 'production') ? true : null,
            'httponly' => true,
            'samesite' => true,
        ];
    }

}
