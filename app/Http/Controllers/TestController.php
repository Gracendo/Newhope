<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.user.dashboard.test-dash');
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
