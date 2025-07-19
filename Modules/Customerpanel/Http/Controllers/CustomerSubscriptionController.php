<?php

namespace Modules\Customerpanel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Models\Subscription;
use Modules\Subscriptionplan\Models\Subscriptionplan;

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

        return view('customerpanel::subscription',$data);
    }

   
}
