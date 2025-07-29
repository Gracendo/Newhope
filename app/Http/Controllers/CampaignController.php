<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        // Only get campaigns with status 'approved'
        $campaigns = Campaign::where('status', 'approved')->get();

        return view('frontend.campaigns', compact('campaigns'));
    }
}