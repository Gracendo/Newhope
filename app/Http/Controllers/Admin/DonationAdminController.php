<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DonationAdminController extends Controller
{
    public function index(Request $request) // Add Request $request parameter
    {
        try {
            $admin = auth('admin')->user();
            $perPage = $request->input('per_page', 15); // Now configurable via request
            $search = $request->input('search'); // Get search term
        
            Log::info('Admin donation access', [
                'admin_id' => $admin->id,
                'role' => $admin->role,
            ]);
            // Get donation statistics
            $totalDonations = Donation::successful()->sum('amount');
            $successfulCount = Donation::successful()->count();
            $pendingCount = Donation::pending()->count();
            $failedCount = Donation::failed()->count();

          
           
             if ($admin->role === 'admin') {
            $donations = Donation::with(['user', 'orphanage', 'campaign'])
                ->when($search, function($query) use ($search) { // Add this line for search
                    $query->where(function($q) use ($search) {
                        $q->where('reference', 'like', "%$search%")
                          ->orWhere('donor_name', 'like', "%$search%")
                          ->orWhere('donor_email', 'like', "%$search%")
                          ->orWhereHas('orphanage', fn($q) => $q->where('name', 'like', "%$search%"))
                          ->orWhereHas('campaign', fn($q) => $q->where('title', 'like', "%$search%"));
                    });
                })
                ->latest()
                ->paginate($perPage);
        }
            else {
            $donations = Donation::where(function ($query) use ($admin) {
                    $query->whereHas('orphanage', function ($q) use ($admin) {
                        $q->where('admin_id', $admin->id);
                    })
                    ->orWhereHas('campaign', function ($q) use ($admin) {
                        $q->where('admin_id', $admin->id);
                    });
                })
                ->when($search, function($query) use ($search) { // Add this line for search
                    $query->where(function($q) use ($search) {
                        $q->where('reference', 'like', "%$search%")
                          ->orWhere('donor_name', 'like', "%$search%")
                          ->orWhere('donor_email', 'like', "%$search%");
                    });
                })
                 ->with(['user', 'orphanage', 'campaign'])
                ->latest()
                ->paginate($perPage)
                ->through(function ($donation) {
                    $donation->amount = $donation->amount * 0.9;
                    $donation->raised = $donation->raised * 0.9;
                    return $donation;
                });

            Log::info('Orphanage manager donations filtered', [
                'original_count' => Donation::count(),
                'filtered_count' => $donations->total(),
            ]);
        }

                  
            return view('backend.donation', [
                'donations' => $donations,
                'admin' => $admin,
                'totalDonations' => $totalDonations,
               
            ]);
        } catch (\Exception $e) {
            Log::error('Donation index error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'An error occurred while loading donations.');
        }
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
        $donation->slug = $request->slug ?? Str::slug($request->title).'-'.Str::random(5);
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

    // public function chartData(Request $request)
    // {
    //     $days = $request->input('days', 30);

    //     $data = Donation::successful()
    //         ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
    //         ->where('created_at', '>=', now()->subDays($days))
    //         ->groupBy('date')
    //         ->orderBy('date')
    //         ->get();

    //     return response()->json([
    //         'labels' => $data->pluck('date')->map(function ($date) {
    //             return \Carbon\Carbon::parse($date)->format('M d');
    //         }),
    //         'data' => $data->pluck('total'),
    //     ]);
    // }
}
