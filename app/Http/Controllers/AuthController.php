<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($request->wantsJson()) {
            try {
                $token = auth('api')->attempt($credentials);

                if (! $token) {
                    return $this->jsonResponse(401, 'Email/ password salah');
                }

                return $this->jsonResponse(200, 'Berhasil login', [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => config('jwt.ttl') * 60,
                ]);
            } catch (\Exception $e) {
                return $this->jsonResponse(401, $e->getMessage());
            } catch (JWTException $e) {
                return $this->jsonResponse(500, $e->getMessage());
            }
        }

        if (! auth()->attempt($credentials)) {
            return $request->wantsJson()
                ? $this->jsonResponse(401, 'Unauthorized')
                : redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->regenerate();

        return to_route('product.lists.index');
    }

    public function logout(Request $request)
    {
        if ($request->wantsJson()) {
            $token = $request->bearerToken();

            try {
                JWTAuth::setToken($token)->invalidate();

                return $this->jsonResponse(200, 'Successfully logged out');
            } catch (\Exception $e) {
                return $this->jsonResponse(500, $e->getMessage());
            }
        }

        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('auth.index');
    }
}
