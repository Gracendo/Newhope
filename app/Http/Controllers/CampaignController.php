<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all(); // Get all campaigns from database

        return view('frontend.campaigns', compact('campaigns'));
    }
}
