<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home'); // Returns the home.blade.php view
    }

    public function ajax_login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|min:6',
        ], [
            'username.required' => __('username required'),
            'password.required' => __('password required'),
            'passwword.min' => __('password length must be 6 characters'),
        ]);

        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {
            $user_details = auth('web')->user();
            if (!is_null($user_details) && $user_details->deactivate === 1) {
                return response()->json([
                    'msg' => __('Your account is deactivated'),
                    'type' => 'danger',
                    'status' => 'invalid',
                ]);
            }

            return response()->json([
                'msg' => __('login Success Redirecting'),
                'type' => 'danger',
                'status' => 'valid',
            ]);
        }

        return response()->json([
            'msg' => __('Username Or Password Doest Not Matched !!!'),
            'type' => 'danger',
            'status' => 'invalid',
        ]);
    }
}
