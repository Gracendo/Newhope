<?php

namespace App\Exports;

use App\Models\Campaign;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class CampaignVolunteersExport implements FromCollection, WithHeadings
{
    protected $campaign;
    protected $volunteers;

    public function __construct(Campaign $campaign, $volunteers)
    {
        $this->campaign = $campaign;
        $this->volunteers = $volunteers;
    }

    public function collection()
    {
        try {
            return $this->volunteers->map(function ($volunteer) {
                // Combine first_name and last_name to make full name
                $fullName = trim($volunteer->user->first_name . ' ' . $volunteer->user->last_name);
                
                // Get phone number - try volunteer table first, then user table
                $phone = $volunteer->phone ?? $volunteer->user->phone ?? 'N/A';
                
                // Format the created_at date safely
                $appliedDate = $volunteer->created_at ? $volunteer->created_at->format('M d, Y') : 'N/A';
                
                return [
                    'Name' => $fullName,          // Combined name
                    'Email' => $volunteer->user->email ?? 'N/A',
                    'Phone' => $phone,
                    'Status' => ucfirst($volunteer->status),  // Capitalize first letter
                    'Applied On' => $appliedDate
                ];
            });
        } catch (\Exception $e) {
            Log::error('Excel Export Error', [
                'campaign_id' => $this->campaign->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return collect(); // Return empty collection if error occurs
        }
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Status',
            'Applied On'
        ];
    }
}