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
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function user_index()
    {
        $donation = CauseLogs::where('user_id', $this->logged_user_details()->id)->count();
        $campaigns = Campaign::where('user_id', $this->logged_user_details()->id)->count();
        $total_reward_points = CauseLogs::where('user_id', $this->logged_user_details()->id)->sum('reward_point');
        $total_requested_amount = RewardRedeem::where('user_id', $this->logged_user_details()->id)->get()->pluck('withdraw_request_amount')->sum();
        $requested_points = $total_requested_amount * get_static_option('reward_amount_for_point');
        $donation_reward =  $total_reward_points - $requested_points;

        return view('frontend.user.dashboard.user-home')->with(
            [
                'donation' => $donation,
                'campaigns' => $campaigns,
                'donation_reward' => $donation_reward,
            ]);
    }

    public function logged_user_details()
    {
        $old_details = '';
        if (empty($old_details)) {
            $old_details = User::findOrFail(Auth::guard('web')->user()->id);
        }
        return $old_details;
    }
}
