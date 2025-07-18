<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customer\Models\Customer;
use Modules\Equipment\Models\Equipment;
use Modules\Subscription\Models\Subscription;

class DashboardController extends Controller
{
    
    public function index()
    {
        $data['total_customer'] = Customer::count();
        $data['total_equipment'] = Equipment::count();
        $data['total_subscription'] = Subscription::count();
        $data['total_subscription_amount'] = Subscription::sum('amount');
        return view('dashboard::index', $data);
    }

    
}
