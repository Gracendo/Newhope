<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\RewardRedeem;
use App\Models\Donation;
use App\Models\CauseLogs;
use App\Models\Campaign;
use App\Models\User;

class UserDashboardController extends Controller
{
   public function index()
    {
        return view('frontend.user.dashboard.user-home');
    }

    public function mycampaigns()
    {
        return view('frontend.user.dashboard.mycampaigns');
    }

    public function donations()
    {
        return view('frontend.user.dashboard.donations');
    }

    public function profilesetting()
{
    $user = Auth::user(); // Get authenticated user
    return view('frontend.user.dashboard.profilesetting', compact('user'));
}

    public function myrewards()
    {
        return view('frontend.user.dashboard.myrewards');
    }

    public function changepassword()
    {
        return view('frontend.user.dashboard.changepassword');
    }
    public function updateProfile(Request $request)
{
    $user = Auth::user();
    
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'state' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);
    
    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        // Delete old image if exists
        if ($user->profile_image) {
            Storage::delete($user->profile_image);
        }
        
        $path = $request->file('profile_image')->store('profile_images', 'public');
        $validated['profile_image'] = $path;
    }
    
    $user->update($validated);
    
    return back()->with('success', 'Profile updated successfully!');
}
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home')->with('success', 'You have been logged out successfully!');
}
}
