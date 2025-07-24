<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Orphanage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignsController extends Controller
{
    /**
     * Store a newly created campaign
     */
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'orphanage_id' => 'required|exists:orphanages,id',
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gallery' => 'max:5', // Max 5 images
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'project_duration' => 'nullable|string|max:255',
            'objectif' => 'nullable|string',
            'description' => 'nullable|string',
            'goal_amount' => 'required|numeric|min:0',
            'raised_amount' => 'nullable|numeric|min:0',
            'business_plan' => 'required|mimes:pdf|max:5120',
        ]);

        try {
            // Ensure admin is authenticated
            if (!Auth::guard('admin')->check()) {
                throw new \Exception('Unauthorized access');
            }

            $admin = Auth::guard('admin')->user();
            Log::info('Attempting to create new campaign', [
                'admin_id' => $admin->id,
                'role' => $admin->role
            ]);

            // Handle file uploads
            $imagePath = $this->uploadFile($request->file('image'), 'campaigns/images');
            
            $galleryPaths = [];
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $image) {
                    $galleryPaths[] = $this->uploadFile($image, 'campaigns/gallery');
                }
            }

            $businessPlanPath = $this->uploadFile($request->file('business_plan'), 'campaigns/business_plans');

            // Set status based on role
            $status = $admin->role === 'orphanagemanager' ? 'pending' : 'approved';

            // Create campaign
            $campaign = Campaign::create([
                'orphanage_id' => $validated['orphanage_id'],
                'admin_id' => $admin->id,
                'name' => $validated['name'],
                'image' => $imagePath,
                'gallery' => !empty($galleryPaths) ? json_encode($galleryPaths) : null,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'project_duration' => $validated['project_duration'],
                'objectif' => $validated['objectif'],
                'description' => $validated['description'],
                'goal_amount' => $validated['goal_amount'],
                'raised_amount' => $validated['raised_amount'] ?? 0,
                'status' => $status,
                'business_plan' => $businessPlanPath,
            ]);

            Log::info('Campaign created successfully', [
                'campaign_id' => $campaign->id,
                'status' => $status
            ]);

            return redirect()->back()
                ->with('success', 'Campaign created successfully! Status: ' . ucfirst($status));

        } catch (\Exception $e) {
            Log::error('Campaign creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Failed to create campaign: ' . $e->getMessage());
        }
    }

    /**
     * Download business plan
     */
    public function downloadBusinessPlan(Campaign $campaign)
{
    try {
        if (!Auth::guard('admin')->check()) {
            throw new \Exception('Unauthorized access');
        }

        if (!Storage::disk('public')->exists($campaign->business_plan)) {
            throw new \Exception('Business plan file not found');
        }

        Log::info('Business plan downloaded', [
            'campaign_id' => $campaign->id,
            'admin_id' => Auth::guard('admin')->id()
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

    /**
     * Approve a campaign (admin only)
     */
    public function approve(Campaign $campaign)
    {
        try {
            if (!Auth::guard('admin')->user()->isAdmin()) {
                throw new \Exception('Only admins can approve campaigns');
            }

            $campaign->update(['status' => 'approved']);
            
            Log::info('Campaign approved', [
                'campaign_id' => $campaign->id,
                'admin_id' => Auth::guard('admin')->id()
            ]);

            return back()->with('success', 'Campaign approved successfully!');

        } catch (\Exception $e) {
            Log::error('Campaign approval failed', [
                'campaign_id' => $campaign->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Reject a campaign (admin only)
     */
    public function reject(Campaign $campaign)
    {
        try {
            if (!Auth::guard('admin')->user()->isAdmin()) {
                throw new \Exception('Only admins can reject campaigns');
            }

            $campaign->update(['status' => 'rejected']);
            
            Log::info('Campaign rejected', [
                'campaign_id' => $campaign->id,
                'admin_id' => Auth::guard('admin')->id()
            ]);

            return back()->with('success', 'Campaign rejected successfully!');

        } catch (\Exception $e) {
            Log::error('Campaign rejection failed', [
                'campaign_id' => $campaign->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show campaign details (only for approved campaigns)
     */
    public function show(Campaign $campaign)
    {
        try {
            if (!$campaign->isApproved()) {
                throw new \Exception('This campaign is not yet approved for viewing');
            }

            return view('admin.campaigns.show', compact('campaign'));

        } catch (\Exception $e) {
            Log::error('Campaign view failed', [
                'campaign_id' => $campaign->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Helper method for file uploads
     */
    private function uploadFile($file, $directory)
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = Str::slug($originalName) . '_' . time() . '.' . $extension;
        
        return $file->storeAs($directory, $fileName, 'public');
    }
}