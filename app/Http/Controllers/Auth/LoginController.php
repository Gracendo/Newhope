<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        Log::info('Showing login form');
        return view('frontend.user.login');
    }

    public function login(Request $request)
    {
        try {
            Log::info('Login attempt', ['username' => $request->username]);
            
            $credentials = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);
            if (Auth::attempt($credentials, $request->remember)) {
                Log::info('Login successful', ['user_id' => Auth::id()]);
                $request->session()->regenerate();
                return redirect()->intended(route('user.home'));
            }

            Log::warning('Login failed - invalid credentials');
            return back()->withErrors([
                'username' => 'Invalid credentials',
            ])->onlyInput('username');

        } catch (\Exception $e) {
            Log::error('Login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Login failed. Please try again.');
        }
    }
    /**
     * show admin login page
    **/
    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:6'
        ], [
            'username.required' => __('username required'),
            'password.required' => __('password required')
        ]);

        //Avant d'authentifier un admin, vérifie s'il a été approuvé

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return response()->json([
                'msg' => __('Login Success Redirecting'),
                'type' => 'success',
                'status' => 'ok'
            ]);
        }
        return response()->json([
            'msg' => __('Your Username or Password Is Wrong !!'),
            'type' => 'danger',
            'status' => 'not_ok',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
