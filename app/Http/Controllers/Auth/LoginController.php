<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use NoCaptcha\Facades\NoCaptcha;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function authenticate(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        try {
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->route('home');
                  }
                  else{
                      return back()->withErrors([
                          'username' => 'Kredensial yang anda miliki tidak ditemukan, pastikan nama username dan kata sandi sesuai.',
                      ])->onlyInput('username');
                  }
            }
          }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    public function api(Request $request) {
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('CSHOP_API')->plainTextToken; // For Sanctum
            return response()->json(['access_token' => $token]);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function api_logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
