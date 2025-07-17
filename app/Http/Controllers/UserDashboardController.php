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

class UserDashboardController extends Controller
{
   public function index()
    {
        return view('frontend.user.dashboard.user-home');
    }

    public function mycampaigns()
    {
        return view('frontend.user.dashboard.mycampaigns');
    }

    public function donations()
    {
        return view('frontend.user.dashboard.donations');
    }

    public function profilesetting()
    {
        return view('frontend.user.dashboard.profilesetting');
    }

    public function myrewards()
    {
        return view('frontend.user.dashboard.myrewards');
    }

    public function changepassword()
    {
        return view('frontend.user.dashboard.changepassword');
    }
}
