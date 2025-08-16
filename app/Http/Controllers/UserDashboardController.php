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
use App\Models\UserPoint;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Log;


class UserDashboardController extends Controller
{
   public function index()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                Log::warning('Unauthenticated user attempted to access dashboard');
                return redirect()->route('login')->with('error', 'Please login to access your dashboard');
            }

            // Get volunteer statistics
            $volunteerStats = $this->getVolunteerStats($user->id);
            // Get donation statistics
            $donationStats = $this->getDonationStats($user->id);
            
            

            return view('frontend.user.dashboard.user-home', [
                'user' => $user,
                'volunteerStats' => $volunteerStats,
                'donationStats' => $donationStats,
                
            ]);
             } catch (\Exception $e) {
            Log::error('Dashboard loading error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'An error occurred while loading your dashboard');
        }
    }

     protected function getVolunteerStats($userId)
    {
        return [
            'totalCampaigns' => Volunteer::where('user_id', $userId)->count(),
            'pendingRequests' => Volunteer::where('user_id', $userId)
                                        ->where('status', 'pending')
                                        ->count(),
            'approvedRequests' => Volunteer::where('user_id', $userId)
                                        ->where('status', 'approved')
                                        ->count(),
            'totalExperience' => Volunteer::where('user_id', $userId)
                                        ->where('status', 'approved')
                                        ->count(),
        ];
    }
    protected function getDonationStats($userId)
    {
        $totalDonations = Donation::where('user_id', $userId)
                                ->where('status', Donation::STATUS_SUCCESSFUL)
                                ->sum('amount');
                                
        $monthlyDonations = Donation::where('user_id', $userId)
                                  ->where('status', Donation::STATUS_SUCCESSFUL)
                                  ->whereMonth('created_at', now()->month)
                                  ->sum('amount');

        return [
            'totalDonations' => $totalDonations,
            'monthlyDonations' => $monthlyDonations,
        ];
    }
    
public function mycampaigns(Request $request)
{
    try {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your campaigns');
        }

        // Get user's total points
        $userPoints = UserPoint::where('user_id', $user->id)->first();
        $totalPoints = $userPoints ? $userPoints->points : 0;

        // Get paginated donations
        $donations = Donation::with('campaign')
            ->where('user_id', $user->id)
            ->where('status', Donation::STATUS_SUCCESSFUL)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'donations_page');

        // Get paginated volunteer activities
        $volunteers = Volunteer::with('campaign')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'volunteers_page');

        // Format the data
        $campaigns = [];
        $counter = 1;

        foreach ($donations as $donation) {
            $campaigns[] = [
                'number' => $counter++,
                'name' => $donation->campaign->name ?? 'Unknown Campaign',
                'type' => 'Donation',
                'amount' => number_format($donation->amount),
                'status' => 'Completed',
                'points' => '5 points',
                'badge_class' => 'bg-info',
                'status_class' => 'bg-success',
                'date' => $donation->created_at->format('M d, Y')
            ];
        }

        foreach ($volunteers as $volunteer) {
            $campaigns[] = [
                'number' => $counter++,
                'name' => $volunteer->campaign->name ?? 'Unknown Campaign',
                'type' => 'Volunteer',
                'amount' => '-',
                'status' => ucfirst($volunteer->status),
                'points' => $volunteer->status === 'approved' ? '10 points' : '0 points',
                'badge_class' => 'bg-warning text-dark',
                'status_class' => $this->getStatusClass($volunteer->status),
                'date' => $volunteer->created_at->format('M d, Y')
            ];
        }

        // Sort by date
        usort($campaigns, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));

        return view('frontend.user.dashboard.mycampaigns', [
            'campaigns' => $campaigns,
            'donations' => $donations,
            'volunteers' => $volunteers,
            'totalPoints' => $totalPoints,
            'user' => $user
        ]);

    } catch (\Exception $e) {
        Log::error('Campaigns error: ' . $e->getMessage());
        return back()->with('error', 'Failed to load campaigns');
    }
}

protected function getStatusClass($status)
{
    switch ($status) {
        case 'approved': return 'bg-success';
        case 'rejected': return 'bg-danger';
        case 'pending': return 'bg-primary';
        default: return 'bg-secondary';
    }
}

   public function donations(Request $request)
{
    try {
        $user = Auth::user();
        
        if (!$user) {
            Log::warning('Unauthenticated user attempted to access donations');
            return redirect()->route('login')->with('error', 'Please login to view your donations');
        }

        // Get user's total points
        $userPoints = UserPoint::where('user_id', $user->id)->first();
        $totalPoints = $userPoints ? $userPoints->points : 0;

        // Get paginated donations with related campaign/orphanage info
        $donations = Donation::with(['campaign', 'orphanage'])
            ->where('user_id', $user->id)
            ->where('status', Donation::STATUS_SUCCESSFUL)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.user.dashboard.donations', [
            'donations' => $donations,
            'totalPoints' => $totalPoints,
            'user' => $user
        ]);

    } catch (\Exception $e) {
        Log::error('Donations loading error: ' . $e->getMessage(), [
            'user_id' => Auth::id(),
            'trace' => $e->getTraceAsString()
        ]);
        return back()->with('error', 'An error occurred while loading your donations');
    }
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
