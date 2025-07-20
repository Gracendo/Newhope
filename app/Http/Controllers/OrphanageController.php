<?php

namespace App\Http\Controllers;

use App\Models\Orphanage;

class OrphanageController extends Controller
{
    public function index()
    {
        $orphanages = Orphanage::all();

        return view('frontend.orphanages', compact('orphanages'));
    }
}
