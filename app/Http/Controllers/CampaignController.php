<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orphanage;
use App\Models\Campaign;
use App\Models\Admin;
use App\Models\Lang;
use App\Models\User;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns =  Campaign::all(); // Get all campaigns from database
        return view('frontend.campaigns', compact('campaigns'));
    }
   
}
