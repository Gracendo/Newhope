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
    try {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:6'
        ], [
            'username.required' => __('username required'),
            'password.required' => __('password required')
        ]);

        Log::info('Admin login attempt', ['username' => $request->username]);

        // Attempt authentication
        if (Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password
        ], $request->get('remember'))) 
        {
            $admin = Auth::guard('admin')->user();
            
            Log::debug('Admin authenticated', [
                'admin_id' => $admin->id,
                'status' => $admin->status
            ]);

            // Check approval status
            if ($admin->status !== 'approved') {
                Auth::guard('admin')->logout();
                
                Log::warning('Admin not approved', ['admin_id' => $admin->id]);
                
                return response()->json([
                    'msg' => __('Your account is pending admin approval'),
                    'type' => 'warning',
                    'status' => 'not_approved',
                    'redirect' => null // No redirect
                ]);
            }

            Log::info('Admin login successful', ['admin_id' => $admin->id]);
            
            return response()->json([
                'msg' => __('Login Success Redirecting'),
                'type' => 'success',
                'status' => 'ok',
                'redirect' => url('admin-dash')  // Explicit redirect
            ]);
        }

        Log::warning('Invalid admin login credentials', ['username' => $request->username]);
        
        return response()->json([
            'msg' => __('Your Username or Password Is Wrong !!'),
            'type' => 'danger',
            'status' => 'not_ok',
        ]);

    } catch (\Exception $e) {
        Log::error('Admin login error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'username' => $request->username ?? 'unknown'
        ]);
        
        return response()->json([
            'msg' => __('Login temporarily unavailable'),
            'type' => 'danger',
            'status' => 'error',
        ]);
    }
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
