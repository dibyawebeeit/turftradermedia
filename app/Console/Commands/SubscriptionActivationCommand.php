<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Equipment\Models\Equipment;
use Modules\Subscription\Models\Subscription;

class SubscriptionActivationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:subscription-activation-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscription Activation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // 1. Find all active subscriptions that are expired
        $expiredSubscriptions = Subscription::where('status', 'active')
            ->whereDate('end_date', '<', $today)
            ->get();

        foreach ($expiredSubscriptions as $subscription) {
            $subscription->status = 'expired';
            $subscription->save();

            $customerId = $subscription->customer_id;

            //Inactive all eqipments of that customer
            Equipment::where('customer_id',$customerId)->update(['publish_status' => 0]);
            //Inactive all eqipments of that customer

            // 2. Find next pending subscription for same user (excluding current)
            $nextSubscription = Subscription::where('customer_id', $customerId)
                ->where('status', 'pending')
                ->orderBy('id') // Or start_date if pre-defined
                ->first();

            if ($nextSubscription) {
                // Set new start and end dates
                $newStartDate = Carbon::now();
                // Use duration (in days) to calculate end date
                $newEndDate = $newStartDate->copy()->addDays($nextSubscription->plan->duration);

                $nextSubscription->update([
                    'status' => 'active',
                    'start_date' => $newStartDate,
                    'end_date' => $newEndDate,
                ]);

                //Active Equipment of that customer
                $no_of_listing = $nextSubscription->plan->no_of_listing;
                $latestEquipments = Equipment::where('customer_id', $customerId)
                    ->latest() // order by created_at desc
                    ->take($no_of_listing)
                    ->get();

                foreach ($latestEquipments as $equipment) {
                    $equipment->update(['publish_status' => 1]);
                }
                //Active Equipment of that customer


            }
        }

        $this->info('Subscription statuses updated successfully.');
    }
}
