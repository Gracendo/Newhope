<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orphanage;
use App\Models\Campaign;
use App\Models\Admin;
use App\Models\Lang;
use App\Models\User;

class CampaignDetailController extends Controller
{
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id); // Get single campaign
        return view('frontend.campaign_detail', compact('campaign'));
    }
}
