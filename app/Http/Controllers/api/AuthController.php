<?php

namespace App\Http\Controllers\api;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
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
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        $dt = User::where('email',$request->email)
                        ->join('role as b', 'users.role_id', '=', 'b.id')
                        ->select(
                        'users.*',
                        'b.nama_role'
                        )
                        ->first();
        if ($dt->role->nama_role!='Admin Cabang') {
            return response()->json(['message' => 'Username atau password anda salah.'], 500);
        }

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['message' => 'Username atau password anda salah.'], 500);
        }
        //echo $role;
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json([
            auth()->user(),
            "role" =>$user->role,
            "cabang" =>$user->cabang,
            "provinsi" =>$user->cabang->getProvinsi,
            "kota" =>$user->cabang->getKota
        ]
        );
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
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}