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

    public function campaign()
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

   public function edit(Campaign $campaign)
{
    $campaign->load(['orphanage']); // Eager load relationships
    
    return response()->json([
        'campaign' => $campaign,
        'orphanages' => Orphanage::all(), // Include all orphanages for the dropdown
        'current_image_url' => $campaign->image ? asset('storage/' . $campaign->image) : null,
        'business_plan_url' => $campaign->business_plan ? asset('storage/' . $campaign->business_plan) : null
    ]);
}
   public function update(Request $request, Campaign $campaign)
{
    // 1. Validate the incoming request data
    $validatedData = $request->validate([
        'orphanage_id' => 'required|exists:orphanages,id',
        'name' => 'required|string|max:255',
        'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'project_duration' => 'nullable|string|max:255',
        'objectif' => 'nullable|string',
        'description' => 'nullable|string',
        'goal_amount' => 'required|numeric|min:0',
        'prefered_amounts' => 'nullable|string',
        'raised_amount' => 'nullable|numeric|min:0',
        'status' => 'required|string|in:pending,inProgress,completed',
        'business_plan' => 'sometimes|mimes:pdf|max:5120',
    ]);

    // 2. Handle file uploads if they exist
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($campaign->image && Storage::disk('public')->exists($campaign->image)) {
            Storage::disk('public')->delete($campaign->image);
        }
        
        // Store new image
        $imagePath = $request->file('image')->store('campaigns/images', 'public');
        $validatedData['image'] = $imagePath;
    }

    // 3. Handle gallery images update
    if ($request->hasFile('gallery')) {
        // Delete old gallery images if they exist
        if ($campaign->gallery) {
            $oldGallery = json_decode($campaign->gallery, true);
            foreach ($oldGallery as $oldImage) {
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }
        
        // Store new gallery images
        $galleryPaths = [];
        foreach ($request->file('gallery') as $image) {
            $galleryPaths[] = $image->store('campaigns/gallery', 'public');
        }
        $validatedData['gallery'] = json_encode($galleryPaths);
    }

    // 4. Handle business plan update
    if ($request->hasFile('business_plan')) {
        // Delete old business plan if it exists
        if ($campaign->business_plan && Storage::disk('public')->exists($campaign->business_plan)) {
            Storage::disk('public')->delete($campaign->business_plan);
        }
        
        // Store new business plan
        $businessPlanPath = $request->file('business_plan')->store('campaigns/business_plans', 'public');
        $validatedData['business_plan'] = $businessPlanPath;
    }

    // 5. Parse preferred amounts if provided
    if ($request->has('prefered_amounts')) {
        $preferedAmounts = array_map('trim', explode(',', $request->input('prefered_amounts')));
        $validatedData['prefered_amounts'] = json_encode($preferedAmounts);
    }

    // 6. Update the campaign with validated data
    $campaign->update($validatedData);

    // 7. Redirect back with success message
    return redirect()->route('admin.campaign')
                   ->with('success', 'Campaign updated successfully!');
}
}
