<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrphanageController extends Controller
{
     public function index()
    {
        return view('frontend.orphanages');
    }
}
