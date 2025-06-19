<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Lang;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:home_variant',['only' => ['home_variant','update_home_variant']]);
    }
    
    public function adminIndex()
    {
        $total_admin = Admin::count();
        $total_user = User::count();

        return view('backend.admin_dashboard');
    }
     public function manageUsers()
    {
        return view('backend.manage_users');
    }
     public function addUsers()
    {
        return view('backend.forms.add_user_form');
    }
}
