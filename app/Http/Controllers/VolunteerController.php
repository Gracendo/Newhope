<?php

namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
}