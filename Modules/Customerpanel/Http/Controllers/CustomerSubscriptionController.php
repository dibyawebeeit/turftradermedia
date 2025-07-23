<?php

namespace Modules\Customerpanel\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Models\Subscription;
use Modules\Subscriptionplan\Models\Subscriptionplan;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Srmklive\PayPal\Services\PayPal;

class CustomerSubscriptionController extends Controller
{
    public $activemenu;
    public $activeCustomerId;

    public function __construct()
    {
        // Ensure middleware has already run
        $this->middleware(function ($request, $next) {
            if (Auth::guard('customer')->check()) {
                $this->activeCustomerId = Auth::guard('customer')->id();
            }

            return $next($request);
        });
    }
    
    public function index()
    {
        
        $this->activemenu = "subscription";
        $data['activemenu'] = $this->activemenu;

        $data['activeSubscription'] =null;

        if(Auth::guard('customer')->user()->is_free == true)
        {
            $data['status'] = "free";
        }
        else
        {
            $subscription = Subscription::where('customer_id', $this->activeCustomerId)
            ->where('status', 'active')
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->first();

            if ($subscription) {
                $data['activeSubscription'] = $subscription;
                $data['status'] = "active";
            }
            else
            {
                $data['status'] = "expired";
            }
        }



        $data['subscriptionplan'] = Subscriptionplan::active()->get();

        $data['upcomingSubscription'] = Subscription::where('customer_id', $this->activeCustomerId)
            ->where('status', 'pending')
            ->get();

        return view('customerpanel::subscription',$data);
    }

    public function renewstartPayment(Request $request)
    {
        $subscriptionId = $request->query('id');
        $type = $request->query('type'); // 'monthly' or 'annual'

        $subscription = Subscriptionplan::findOrFail($subscriptionId);

        if (!$subscription) {
            abort(400, 'Invalid subscription');
        }

        $price = $subscription->monthly_price;
        // Start date is now
        $start_date = Carbon::now();

        // Use duration (in days) to calculate end date
        $end_date = $start_date->copy()->addDays($subscription->duration);

        session([
            'subscription' => [
                'id' => $subscriptionId,
                'price' => $price,
                'start_date' => $start_date->toDateString(),
                'end_date' => $price == 0 ? null : $end_date->toDateString(),
                'type' => $type
            ]
        ]);

        return redirect()->route('customer.renew_subscription_booking');
    }

    public function renew_subscription_booking(Request $request)
    {
        $total_amount = session('subscription.price');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('customer.renew_subscription_success'),
                "cancel_url" => route('customer.renew_subscription_cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total_amount,
                    ]
                ]
            ]
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('customer.renew_subscription_cancel');
    }

    public function renew_subscription_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if ($response['status'] === 'COMPLETED') {
            $payment_id = $request->token;
            $this->complete_subscription($payment_id);
            return redirect()->route('customer.thankyou');
        }

        return redirect()->route('customer.oops');
    }

    public function complete_subscription($payment_id)
    {
        $subscription = session('subscription');

      
        $isSubscriptionExist = Subscription::where('customer_id', $this->activeCustomerId)->exists();
        if ($isSubscriptionExist) {
            $subscriptionDetails = Subscription::where('customer_id', $this->activeCustomerId)->latest()->first();

            // Determine subscription status
            if ($subscriptionDetails && $subscriptionDetails->status === 'active') {
                $subscription_status = 'pending';
            } elseif ($subscriptionDetails && $subscriptionDetails->status === 'pending') {
                $subscription_status = 'pending';
            }
            else {
                // For expired or unknown, assume active (new upgrade)
                $subscription_status = 'active';
            }

            // Set dates based on subscription status
            if ($subscription_status === 'pending') {
                $start_date = null;
                $end_date = null;
            } else {
                $start_date = $subscription['start_date'] ?? null;
                $end_date = $subscription['end_date'] ?? null;
            }
        } 
        else {
            $subscription_status = 'active';
            $start_date = $subscription['start_date'] ?? null;
            $end_date = $subscription['end_date'] ?? null;

        }
        
        $subscriptionData = [
            'customer_id' => $this->activeCustomerId,
            'subscription_plan_id' => $subscription['id'],
            'start_date' => $start_date,
            'end_date' => $end_date, // could be null for free
            'type' => $subscription['type'],
            'amount' => $subscription['price'],
            'txn_id' => $payment_id,
            'payment_type' => 'online',
            'status' => $subscription_status
        ];

        $createdSubscription = Subscription::create($subscriptionData);

        session()->forget(['subscription']);

        return true;
    }

    public function renew_subscription_cancel(Request $request)
    {
        return redirect()->route('customer.oops');
    }

    public function thankyou()
    {
        $this->activemenu = "";
        $data['activemenu'] = $this->activemenu;

        $data['msg'] = "Your payment has done successfully!";
        return view('customerpanel::thankyou',$data);
    }
    public function oops()
    {
        $this->activemenu = "";
        $data['activemenu'] = $this->activemenu;
        
        $data['msg'] = "Sorry, your payment has failed!";
        return view('customerpanel::oops',$data);
    }

   
}
