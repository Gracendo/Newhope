<?php

namespace App\Http\Controllers;

use App\Models\Orphanage;

class OrphanageDetailController extends Controller
{
    public function show($id)
    {
        $orphanage = Orphanage::findOrFail($id); // Get single campaign

        return view('frontend.orphanage_detail', compact('orphanage'));
    }
}
