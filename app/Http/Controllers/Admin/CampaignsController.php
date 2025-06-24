<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'orphanage_id' => 'required|exists:orphanages,id',
            'name' => 'required|string|max:255',
            'image' => 'required|image',
            'gallery.*' => 'image',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'project_duration' => 'nullable|string|max:255',
            'objectif' => 'nullable|string',
            'description' => 'nullable|string',
            'goal_amount' => 'required|numeric|min:0',
            'prefered_amounts' => 'nullable|string', // will be parsed
            'raised_amount' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:pending,active,completed',
            'business_plan' => 'required|mimes:pdf',
        ]);

        // Upload image
        $imagePath = $request->file('image')->store('campaigns/images', 'public');

        // Upload gallery images
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('campaigns/gallery', 'public');
            }
        }

        // Upload business plan
        $businessPlanPath = $request->file('business_plan')->store('campaigns/business_plans', 'public');

        // Parse preferred amounts (comma-separated)
        $preferedAmounts = array_map('trim', explode(',', $request->input('prefered_amounts')));

        // Create campaign
        $project = Campaign::create([
            'Orphanage_id' => $request->orphanage_id,
            'name' => $request->name,
            'image' => $imagePath,
            'gallery' => json_encode($galleryPaths),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'project_duration' => $request->project_duration,
            'objectif' => $request->objectif,
            'description' => $request->description,
            'goal_amount' => $request->goal_amount,
            'prefered_amounts' => json_encode($preferedAmounts),
            'raised_amount' => $request->raised_amount ?? 0,
            'status' => $request->status,
            'business_plan' => $businessPlanPath,
        ]);

        return redirect()->back()->with('success', 'Campaign created successfully.');
    }
}
