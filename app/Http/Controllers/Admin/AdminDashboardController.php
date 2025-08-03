<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminApprovalNotification;
use App\Mail\AdminRejectionNotification;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\Orphanage;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Support\Facades\Hash; // Add this
use Illuminate\Support\Facades\Log; // Add this
use Illuminate\Support\Facades\Mail;
use App\Exports\CampaignVolunteersExport;
use App\Exports\CampaignVolunteersPdf;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:home_variant', ['only' => ['home_variant', 'update_home_variant']]);
    }

    // public function adminIndex()
    // {
    //     $total_admin = Admin::count();
    //     $total_user = User::count();

    //     return view('backend.admin_dashboard')->with([
    //         'total_admin' => $total_admin,
    //         'total_user' => $total_user,
    //     ]);
    // }
    public function adminIndex()
    {
        $query = Campaign::with(['orphanage', 'volunteers']);

        // If user is orphanage manager, only show their campaigns
        if (auth()->user()->role === 'orphanagemanager') {
            $query->where('admin_id', auth()->id());
        }

        // 3. Handle search
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('status', 'like', "%$search%");
            });
        }
        // 4. Get statistics
        // Get current date for comparison
        $today = now()->format('Y-m-d');

        // Status counts for the stats cards
        $statusCounts = [
            'total' => (clone $query)->count(),
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'active' => (clone $query)->where('status', 'approved')
                                     ->where('end_date', '>=', $today)
                                     ->count(),
            'completed' => (clone $query)->where('status', 'approved')
                                       ->where('end_date', '<', $today)
                                       ->count(),
            'rejected' => (clone $query)->where('status', 'rejected')->count(),
        ];
         // 5. Paginate results (10 per page)
       
        $campaigns = $query->paginate(10)->withQueryString();
        $orphanages = Orphanage::all();

        Log::info('Campaign dashboard loaded successfully', [
            'total_campaigns' => $statusCounts['total'],
            'pending' => $statusCounts['pending'],
            'active' => $statusCounts['active'],
            'completed' => $statusCounts['completed'],
            'rejected' => $statusCounts['rejected']
        ]);
        // return view('backend.campaign', compact('campaigns', 'statusCounts'));

        // $campaigns = $query->get();
        // $orphanages = Orphanage::all();

        return view('backend.admin_dashboard', compact('campaigns', 'orphanages','statusCounts'));
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
        $query = Campaign::with(['orphanage', 'volunteers']);

        // If user is orphanage manager, only show their campaigns
        if (auth()->user()->role === 'orphanagemanager') {
            $query->where('admin_id', auth()->id());
        }

        $campaigns = $query->get();
        $orphanages = Orphanage::all();

        return view('backend.campaign', compact('campaigns', 'orphanages'));
    }

    public function campaignDetails($id)
    {
        $campaign = Campaign::with(['orphanage', 'volunteers.user'])
                ->findOrFail($id);

        return view('backend.campaign_details',[
        'campaign' => $campaign,
        'volunteers' => $campaign->volunteers()->with('user')->paginate(10)
    ]);
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
            'image' => 'nullable|string|max:191',
        ]);
        Admin::find(Auth::user()->id)->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'image' => $request->image]);

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
            'password' => 'required|string|min:8|confirmed',
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
            'current_image_url' => $campaign->image ? asset('storage/'.$campaign->image) : null,
            'business_plan_url' => $campaign->business_plan ? asset('storage/'.$campaign->business_plan) : null,
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

    /**
     * Approve a pending admin user.
     */
    public function approveUser(Request $request, $userId)
    {
        try {
            Log::info('Attempting to approve user', ['user_id' => $userId, 'approver_id' => Auth::id()]);

            $user = Admin::findOrFail($userId);

            if ($user->status === 'approved') {
                Log::warning('User already approved', ['user_id' => $userId]);

                return redirect()->back()->with([
                    'msg' => __('User is already approved'),
                    'type' => 'warning',
                ]);
            }
            $user->status = 'approved';
            $user->save();

            Log::info('User approved successfully', ['user_id' => $userId]);

            // Send approval email
            // Mail::to($user->email)->send(new AdminApprovalNotification($user));

            return back()->with('success', 'User approved and notified');
        } catch (\Exception $e) {
            Log::error('Failed to approve user', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $userId,
            ]);

            return redirect()->back()->with([
                'msg' => __('Failed to approve user'),
                'type' => 'danger',
            ]);
        }
    }

    /**
     * Reject a pending admin user.
     */
    public function rejectUser(Request $request, $userId)
    {
        try {
            Log::info('Attempting to reject user', ['user_id' => $userId, 'approver_id' => Auth::id()]);

            $user = Admin::findOrFail($userId);

            if ($user->status === 'rejected') {
                Log::warning('User already rejected', ['user_id' => $userId]);

                return redirect()->back()->with([
                    'msg' => __('User is already rejected'),
                    'type' => 'warning',
                ]);
            }
            $user->status = 'rejected';
            $user->save();

            Log::info('User rejected successfully', ['user_id' => $userId]);

            // Send rejection email with optional reason
            // $reason = $request->input('reason');
            // Mail::to($user->email)->send(new AdminRejectionNotification($user, $reason));

            return back()->with('success', 'User rejected and notified');
        } catch (\Exception $e) {
            Log::error('Failed to reject user', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $userId,
            ]);

            return redirect()->back()->with([
                'msg' => __('Failed to reject user'),
                'type' => 'danger',
            ]);
        }
    }

    // approuve volunteer
    public function approveVolunteer(Request $request, $volunteerId)
    {
        try {
            $volunteer = Volunteer::findOrFail($volunteerId);

            // Verify campaign belongs to this admin/orphanage manager
            if (auth()->user()->role === 'orphanagemanager'
                && $volunteer->campaign->admin_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }

            $volunteer->update(['status' => 'approved']);

            Log::info('Volunteer approved', [
                'volunteer_id' => $volunteerId,
                'admin_id' => auth()->id(),
                'campaign_id' => $volunteer->campaign_id,
            ]);

                        return back()->with('success', 'Volunteer approved and notified');

        } catch (\Exception $e) {
            Log::error('Volunteer approval failed', [
                'error' => $e->getMessage(),
                'volunteer_id' => $volunteerId,
            ]);

            return response()->json(['error' => 'Approval failed'], 500);
        }
    }

    public function rejectVolunteer(Request $request, $volunteerId)
    {
        try {
            $volunteer = Volunteer::findOrFail($volunteerId);

            // Verify campaign belongs to this admin/orphanage manager
            if (auth()->user()->role === 'orphanagemanager'
                && $volunteer->campaign->admin_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }

            $volunteer->update(['status' => 'rejected']);

            Log::info('Volunteer rejected', [
                'volunteer_id' => $volunteerId,
                'admin_id' => auth()->id(),
                'campaign_id' => $volunteer->campaign_id,
            ]);

             return response()->json([
            'success' => true,
            'message' => 'Volunteer '.$volunteer->user->name.' has been rejected successfully!',
            'volunteer_name' => $volunteer->user->name,
            'campaign_name' => $volunteer->campaign->name
        ]);
        } catch (\Exception $e) {
            Log::error('Volunteer rejection failed', [
                'error' => $e->getMessage(),
                'volunteer_id' => $volunteerId,
            ]);

            return response()->json([
            'error' => true,
            'message' => 'Failed to reject volunteer: '.$e->getMessage()
        ], 500);
        }
    }
public function exportVolunteersExcel(Campaign $campaign)
{
    try {
        Log::info('Starting Excel export for campaign', ['campaign_id' => $campaign->id]);
        
        $volunteers = $campaign->volunteers()
            ->with(['user' => function($query) {
                $query->select('id', 'first_name', 'last_name', 'email', 'phone');
            }])
            ->get();

        if ($volunteers->isEmpty()) {
            Log::warning('No volunteers found for export', ['campaign_id' => $campaign->id]);
            return back()->with('warning', 'No volunteers found to export.');
        }

        $filename = str_replace(' ', '_', strtolower($campaign->name)) . '_volunteers_' . now()->format('Ymd_His') . '.xlsx';
        
        Log::info('Exporting volunteers to Excel', [
            'campaign_id' => $campaign->id,
            'volunteer_count' => $volunteers->count(),
            'filename' => $filename
        ]);

        return Excel::download(
            new CampaignVolunteersExport($campaign, $volunteers), 
            $filename
        );

    } catch (\Exception $e) {
        Log::error('Excel export failed', [
            'campaign_id' => $campaign->id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return back()->with('error', 'Failed to generate Excel export. Please try again.');
    }
}

public function exportVolunteersPdf(Campaign $campaign)
{
    try {
        Log::info('Starting PDF export for campaign', ['campaign_id' => $campaign->id]);
        
        $volunteers = $campaign->volunteers()
            ->with(['user' => function($query) {
                $query->select('id', 'first_name', 'last_name', 'email', 'phone');
            }])
            ->get();

        if ($volunteers->isEmpty()) {
            Log::warning('No volunteers found for PDF export', ['campaign_id' => $campaign->id]);
            return back()->with('warning', 'No volunteers found to export.');
        }

        $filename = str_replace(' ', '_', strtolower($campaign->name)) . '_volunteers_' . now()->format('Ymd_His') . '.pdf';
        
        Log::info('Exporting volunteers to PDF', [
            'campaign_id' => $campaign->id,
            'volunteer_count' => $volunteers->count(),
            'filename' => $filename
        ]);

        $pdf = PDF::loadView('exports.volunteers-pdf', [
            'campaign' => $campaign,
            'volunteers' => $volunteers
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);

    } catch (\Exception $e) {
        Log::error('PDF export failed', [
            'campaign_id' => $campaign->id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return back()->with('error', 'Failed to generate PDF export. Please try again.');
    }
}
    
}
