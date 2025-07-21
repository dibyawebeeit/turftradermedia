<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
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

            // 2. Find next pending subscription for same user (excluding current)
            $nextSubscription = Subscription::where('customer_id', $customerId)
                ->where('status', 'pending')
                ->orderBy('id') // Or start_date if pre-defined
                ->first();

            if ($nextSubscription) {
                // Set new start and end dates
                $newStartDate = $today;
                $newEndDate = match ($nextSubscription->type) {
                    'monthly' => $newStartDate->copy()->addMonth(),
                    'annual'  => $newStartDate->copy()->addYear(),
                    default   => null
                };

                $nextSubscription->update([
                    'status' => 'active',
                    'start_date' => $newStartDate,
                    'end_date' => $newEndDate,
                ]);
            }
        }

        $this->info('Subscription statuses updated successfully.');
    }
}
