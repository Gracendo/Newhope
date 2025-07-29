<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Orphanage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CampaignsController extends Controller
{
    /**
     * Store a newly created campaign
     */
    public function store(Request $request)
    {
        try {
            // 1. Validate basic fields
            $validated = $request->validate([
                'orphanage_id' => 'required|exists:orphanages,id',
                'name' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                'business_plan' => 'required|mimes:pdf|max:5120',
                'objectif' => 'required|string',
                'description' => 'required|string',
                'goal_amount' => 'required|numeric|min:0',
            ]);

            Log::info('Campaign creation started', ['user_id' => Auth::id()]);

            // 2. Validate dates with custom rules
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $twoWeeksFromNow = Carbon::now()->addWeeks(2);
            $oneWeekAfterStart = $startDate->copy()->addWeek();

            if ($startDate->lt($twoWeeksFromNow)) {
                throw new \Exception('Start date must be at least 2 weeks from now');
            }

            if ($endDate->lt($oneWeekAfterStart)) {
                throw new \Exception('End date must be at least 1 week after start date');
            }

            // 3. Calculate duration
            $durationInDays = $startDate->diffInDays($endDate);
            $projectDuration = $durationInDays . ' days';

            Log::info('Date validation passed', [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'duration' => $projectDuration
            ]);

            // 4. Handle file uploads
            $imagePath = $request->file('image')->store('campaigns/images', 'public');
            
            $galleryPaths = [];
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $image) {
                    $galleryPaths[] = $image->store('campaigns/gallery', 'public');
                }
            }

            $businessPlanPath = $request->file('business_plan')->store('campaigns/business_plans', 'public');

            // 5. Set status based on user role
            $status = Auth::user()->role === 'orphanagemanager' ? 'pending' : 'approved';

            // 6. Create campaign
            $campaign = Campaign::create([
                'orphanage_id' => $validated['orphanage_id'],
                'admin_id' => Auth::id(),
                'name' => $validated['name'],
                'image' => $imagePath,
                'gallery' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'project_duration' => $projectDuration,
                'objectif' => $validated['objectif'],
                'description' => $validated['description'],
                'goal_amount' => $validated['goal_amount'],
                'raised_amount' => 0, // Default to 0
                'status' => $status,
                'business_plan' => $businessPlanPath,
            ]);

            Log::info('Campaign created successfully', ['campaign_id' => $campaign->id]);

            return redirect()->back()->with('success', 'Campaign created successfully!');

        } catch (\Exception $e) {
            Log::error('Campaign creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update an existing campaign
     */
    public function update(Request $request, Campaign $campaign)
    {
        try {
            // Similar validation as store method
            // Add your update logic here
            
            return redirect()->back()->with('success', 'Campaign updated successfully!');
            
        } catch (\Exception $e) {
            Log::error('Campaign update failed', [
                'campaign_id' => $campaign->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Download business plan
     */
    public function downloadBusinessPlan(Campaign $campaign)
    {
        try {
            if (!Storage::disk('public')->exists($campaign->business_plan)) {
                throw new \Exception('File not found');
            }
            
            Log::info('Business plan downloaded', [
                'campaign_id' => $campaign->id,
                'downloader_id' => Auth::id()
            ]);
            
            return Storage::disk('public')->download($campaign->business_plan);
            
        } catch (\Exception $e) {
            Log::error('Business plan download failed', [
                'campaign_id' => $campaign->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }
    protected $casts = [
    'gallery' => 'array',
];

public function isApproved()
{
    return $this->status === 'approved';
}

public function isPending()
{
    return $this->status === 'pending';
}

public function isRejected()
{
    return $this->status === 'rejected';
}

public function reject(Campaign $campaign)
    {
        try {
            // Verify admin privileges
            if (Auth::user()->role !== 'admin') {
                throw new \Exception('Unauthorized action');
            }

            $campaign->update(['status' => 'rejected']);

            Log::info('Campaign rejected', [
                'admin_id' => Auth::id(),
                'campaign_id' => $campaign->id,
                'old_status' => $campaign->getOriginal('status'),
                'new_status' => 'rejected'
            ]);
    return back()->with('success', 'Campaign approved successfully!');

        } catch (\Exception $e) {
            Log::error('Campaign approval failed', [
                'error' => $e->getMessage(),
                'campaign_id' => $campaign->id ?? null,
                'admin_id' => Auth::id()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Approve a campaign (Admin only)
     */
    public function approve(Campaign $campaign)
    {
        try {
            // Verify admin privileges
            if (Auth::user()->role !== 'admin') {
                throw new \Exception('Unauthorized action');
            }

            $campaign->update(['status' => 'approved']);

            Log::info('Campaign approved', [
                'admin_id' => Auth::id(),
                'campaign_id' => $campaign->id,
                'old_status' => $campaign->getOriginal('status'),
                'new_status' => 'approved'
            ]);

            return back()->with('success', 'Campaign approved successfully!');

        } catch (\Exception $e) {
            Log::error('Campaign approval failed', [
                'error' => $e->getMessage(),
                'campaign_id' => $campaign->id ?? null,
                'admin_id' => Auth::id()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }
}
