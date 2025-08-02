<?php

namespace App\Exports;

use App\Models\Campaign;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class CampaignVolunteersPdf
{
    protected $campaign;
    protected $volunteers;

    public function __construct(Campaign $campaign, $volunteers)
    {
        $this->campaign = $campaign;
        $this->volunteers = $volunteers;
    }

    public function view(): View
    {
        try {
            return view('exports.volunteers-pdf', [
                'campaign' => $this->campaign,
                'volunteers' => $this->volunteers
            ]);
        } catch (\Exception $e) {
            Log::error('PDF View Error', [
                'campaign_id' => $this->campaign->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Fallback view if there's an error
            return view('exports.error', [
                'message' => 'Failed to generate PDF report'
            ]);
        }
    }
}