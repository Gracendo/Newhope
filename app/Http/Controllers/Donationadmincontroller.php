<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Donationadmincontroller extends Controller
{
     public function index()
    {
        return view('backend.donation');
    }
}
