<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orphanage;
use App\Models\Campaign;
use App\Models\Admin;
use App\Models\Lang;
use App\Models\User;
use App\Models\Volunteer;

class CampaignDetailController extends Controller
{
    public function show($id)
    {
        // $campaign = Campaign::findOrFail($id); // Get single campaign
        // return view('frontend.campaign_detail', compact('campaign'));
         $campaign = Campaign::with(['orphanage', 'volunteers.user'])->findOrFail($id);
    
    // Initialize variables
    $hasVolunteered = false;
    $volunteerStatus = null;
    
    // Check if user is logged in
    if(auth()->check()) {
        $volunteer = $campaign->volunteers->where('user_id', auth()->id())->first();
        if($volunteer) {
            $hasVolunteered = true;
            $volunteerStatus = $volunteer->status;
        }
    }
    
    return view('frontend.campaign_detail', compact('campaign', 'hasVolunteered', 'volunteerStatus'));
    }
}
