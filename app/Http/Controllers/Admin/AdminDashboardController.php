<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Orphanage;
use App\Models\Campaign;
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

        return view('backend.admin_dashboard')->with([
            'total_admin' => $total_admin,
            'total_user' => $total_user
        ]);
    }

    public function manageUsers()
    {
        $all_user = Admin::all()->except(Auth::id());
        return view('backend.manage_users')->with(['all_user' => $all_user]);
    }

    public function addUsers()
    {
        return view('backend.forms.add_user_form');
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with(['msg' => __('You Logged Out !!'), 'type' => 'danger']);
    }

    public function profilePersonalInfo()
    {
        return view('backend.profile');
    }

    public function Campaign()
    {
        $orphanages = Orphanage::all();
        $campaigns = Campaign::with('orphanage')->get();
        return view('backend.campaign', compact('orphanages','campaigns'));
    }
    
    public function campaignDetails()
    {
        return view('backend.campaign_details');
    }

    public function admin_profile()
    {
        return view('auth.admin.edit-profile');
    }

    public function admin_profile_update(Request $request)
    {
        $user = Auth::guard('admin')->user()->id;
        $this->validate($request, [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|max:191|email|unique:admins,email,'.$user,
            'username' => 'nullable|string|max:191',
            'image' => 'nullable|string|max:191'
        ]);
        Admin::find(Auth::user()->id)->update(['first_name' => $request->first_name,'last_name' => $request->last_name, 'email' => $request->email, 'image' => $request->image]);

        return redirect()->back()->with(['msg' => __('Profil mis à jour'), 'type' => 'success']);
    }

    public function admin_password()
    {
        return view('auth.admin.change-password');
    }

    public function admin_password_chagne(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Admin::findOrFail(Auth::id());

        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('admin.login')->with(['msg' => __('Mot de passe mis à jour avec succès'), 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => __('Un problème est survenu ! Veuillez réessayer ou vérifier votre ancien mot de passe.'), 'type' => 'danger']);
    }
}
