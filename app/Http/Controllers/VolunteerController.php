<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\UserPoint;

class VolunteerController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'campaign_id' => 'required|exists:campaigns,id'
        ]);

        try {
            // Create volunteer record
            $volunteer = Volunteer::create([
                'user_id' => Auth::id(),
                'campaign_id' => $validated['campaign_id'],
                'phone' => Auth::user()->phone,
                'address' => Auth::user()->address,
                'status' => 'pending'
            ]);

            // Log success
            Log::info('New volunteer created', [
                'user_id' => Auth::id(),
                'campaign_id' => $validated['campaign_id']
            ]);

            return redirect()->back()
                ->with('success', 'Volunteer application submitted!');

        } catch (\Exception $e) {
            // Log error
            Log::error('Volunteer creation failed', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to submit volunteer application');
        }
    }
    public function grantReward(Request $request, $volunteerId)
    {
       

        try {
            $volunteer = Volunteer::findOrFail($volunteerId);

            // Verify campaign belongs to this admin/orphanage manager
            if (auth()->user()->role === 'orphanagemanager'
                && $volunteer->campaign->admin_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }

            // Mark reward as granted
            $volunteer->update(['reward_granted' => true]);

            // Add points to user
            $userPoint = UserPoint::firstOrCreate(
                ['user_id' => $volunteer->user_id],
                ['points' => 0]
            );
            $userPoint->increment('points', 10);

            Log::info('Reward granted to volunteer', [
                'volunteer_id' => $volunteerId,
                'user_id' => $volunteer->user_id,
                'points_added' => 10,
                'admin_id' => auth()->id(),
            ]);

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Reward granting failed', [
                'error' => $e->getMessage(),
                'volunteer_id' => $volunteerId,
            ]);

            return response()->json(['error' => 'Reward granting failed'], 500);
        }
    }
}