<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserFunnel;
use App\Models\Package;

class CheckFunnelExpiration extends Command
{
    protected $signature = 'funnel:check-expiration';
    protected $description = 'Check if any funnels have expired and update their status.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Query the user_funnels table for expired funnels
        $funnels = UserFunnel::where('expiration_date', '<', now())
                            ->where('is_active', true)  // Only check active funnels
                            ->get();

        foreach ($funnels as $funnel) {
            // Mark as expired and clear relevant fields in user_funnels table
            $funnel->proof_image = null;
            $funnel->plan_duration = null;
            $funnel->plan_price = null; 
            $funnel->approval_date = null;
            $funnel->submitted_at = null;
            $funnel->is_active = false;         // Deactivate the funnel
            $funnel->status = 'expired';        // Set status to 'expired'
            $funnel->save();

            // Update the packages table: set free_funnel to 'not-free'
            $package = Package::where('user_id', $funnel->user_id)->first();
            if ($package) {
                $package->free_funnel = 'not-free'; // Set the free_funnel field to 'not-free'
                $package->save();
            }

            // Log the action
            $this->info('Funnel marked as expired and deactivated: ID ' . $funnel->id);
        }

        $this->info('Funnel expiration check completed.');
    }
}
