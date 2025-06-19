<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function adminIndex()
    {
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
