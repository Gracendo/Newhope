<?php

namespace App\Http\Controllers;

use App\Models\Orphanage;
use App\Models\Admin;

class OrphanageController extends Controller
{
    public function index()
    {
        // $orphanages = Orphanage::all();
        // Get only orphanages created by approved admins
        $orphanages = Orphanage::whereHas('admin', function($query) {
            $query->where('status', 'approved');
        })->get();
        return view('frontend.orphanages', compact('orphanages'));
    }
}
