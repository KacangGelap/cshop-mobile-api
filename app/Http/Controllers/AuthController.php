<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Auth;
class AuthController extends Controller
{
    // Registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:15|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->password),
        ]);

        // Membuat token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201, [], JSON_PRETTY_PRINT);
    }

    // Login
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);
            if (Auth::attempt($credentials)) {
                $token = $request->user()->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ], 200, [], JSON_PRETTY_PRINT);
            }
        
            return response()->json(['error' => 'Invalid credentials'], 401);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    // Logout
    public function logout(Request $request)
    {
        // Hapus semua token untuk user yang autentikasi
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ], 200, [], JSON_PRETTY_PRINT);
    }
}

