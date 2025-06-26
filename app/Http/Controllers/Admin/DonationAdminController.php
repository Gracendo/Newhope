<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Donation;

class DonationAdminController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();

        if ($admin->hasRole('Super Admin')) {
            $donations = Donation::with(['user', 'admin'])->latest()->get();
        } else {
            $donations = Donation::where('admin_id', $admin->id)->with('user')->latest()->get();
        }

        return view('backend.donation', compact('donations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'donation_content' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'raised' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|in:pending,active,completed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'image_gallery.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'slug' => 'nullable|string|unique:donations,slug',
            'excerpt' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'faq' => 'nullable|string',
            'deadline' => 'nullable|date',
            'featured' => 'nullable|in:yes,no',
            'og_meta_title' => 'nullable|string',
            'og_meta_description' => 'nullable|string',
            'og_meta_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $donation = new Donation();
        $donation->title = $request->title;
        $donation->donation_content = $request->donation_content;
        $donation->amount = $request->amount;
        $donation->raised = $request->raised ?? 0;
        $donation->status = $request->status ?? 'pending';
        $donation->slug = $request->slug ?? Str::slug($request->title) . '-' . Str::random(5);
        $donation->excerpt = $request->excerpt;
        $donation->meta_title = $request->meta_title;
        $donation->meta_tags = $request->meta_tags;
        $donation->meta_description = $request->meta_description;
        $donation->faq = $request->faq;
        $donation->deadline = $request->deadline;
        $donation->featured = $request->featured ?? 'no';
        $donation->og_meta_title = $request->og_meta_title;
        $donation->og_meta_description = $request->og_meta_description;

        // Auth admin ID
        $donation->admin_id = auth('admin')->id();
        $donation->created_by = auth('admin')->user()->username;

        // Image principale
        if ($request->hasFile('image')) {
            $donation->image = $request->file('image')->store('donation_images', 'public');
        }

        // Image OG
        if ($request->hasFile('og_meta_image')) {
            $donation->og_meta_image = $request->file('og_meta_image')->store('og_images', 'public');
        }

        // Galerie (sauvegardée en JSON)
        if ($request->hasFile('image_gallery')) {
            $galleryPaths = [];
            foreach ($request->file('image_gallery') as $image) {
                $galleryPaths[] = $image->store('donation_gallery', 'public');
            }
            $donation->image_gallery = json_encode($galleryPaths);
        }

        $donation->save();

        return redirect()->route('donation_management')->with('success', 'Donation created successfully!');
    }
}
