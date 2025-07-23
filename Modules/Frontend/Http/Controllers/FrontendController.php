<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ForgotpasswordMail;
use App\Mail\SendEnquiryMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\Watchlist;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Modules\Banner\Models\Banner;
use Modules\Category\Models\Category;
use Modules\Cms\Models\Aboutus;
use Modules\Cms\Models\Advertising;
use Modules\Cms\Models\Contactuscms;
use Modules\Cms\Models\Home;
use Modules\Customer\Models\Customer;
use Modules\Customer\Models\CustomerDocument;
use Modules\Equipment\Models\Equipment;
use Modules\EquipmentEnquiry\Models\EquipmentEnquiry;
use Modules\EquipmentModel\Models\EquipmentModel;
use Modules\Manufacturer\Models\Manufacturer;
use Modules\Subscription\Models\Subscription;
use Modules\Subscriptionplan\Models\Subscriptionplan;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Srmklive\PayPal\Services\PayPal;

class FrontendController extends Controller
{
    public function index()
    {
        $data['banner'] = Banner::active()->get();
        $data['categoryList'] = Category::active()->where('parent_id',0)->get();

        // $data['allEquipments'] = Equipment::published()->approved()->orderBy('id','desc')->get();
        $data['allEquipments'] = Equipment::published()->approved()
                                ->whereHas('customer', function ($query) {
                                    $query->where('is_free', true)
                                        ->orWhere(function ($q) {
                                            $q->where('is_free', false)
                                            ->whereHas('subscriptions', function ($sub) {
                                                $today = Carbon::today();
                                                $sub->where('status', 'active')
                                                    ->where('start_date', '<=', $today)
                                                    ->where('end_date', '>=', $today);
                                            });
                                        });
                                })
                                ->with('customer') // optional, if you want customer data too
                                ->orderBy('id', 'desc')
                                ->get();

        $data['manufacturerListing'] = Manufacturer::select('id','name')->active()->get();

        $data['home']=Home::first();
        return view('frontend::index', $data);
    }

    public function getEquipmentModel(Request $request)
    {
        $manufacturerId = $request->manufacturerId;
        try {
            $result = EquipmentModel::where('manufacturer_id',$manufacturerId)->pluck('name','id');
            return response()->json(['status'=> true, 'data'=> $result]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=> false]);
        }
        
    }
    public function signin()
    {
        return view('frontend::signin');
    }

    public function submit_signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required'
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || $customer->status != 1) {
            return redirect()->route('signin')->with('error', 'Account inactive or not found.');
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('customer.dashboard');
        }

        return redirect()->route('signin')->with('error','Invalid Credentials');
    }

    public function forgot_password()
    {
        return view('frontend::forgot_password');
    }

    public function submit_forgot_password(Request $request)
    {
        $email = $request->email;
        $isExist = Customer::where('email', $email)->exists();

        if ($isExist) {
            $otp = rand(111111, 999999);

            $mailData = array(
                'otp' => $otp
            );

            Mail::to($email)->send(new ForgotpasswordMail($mailData));
            
            Session::put('user_email', $email);
            $user = Customer::where('email', $email)->first();
            $user->forgotpassword_code = $otp;
            $user->save();
            return response()->json([
                'status' => true,
                'msg' => 'OTP sent successfully',
                'data' => array('otp' => $otp),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Invalid Email ID',
                'data' => null,
            ]);
        }
    }

    public function submit_otp(Request $request)
    {
        $email = Session::get('user_email');
        $otp = $request->otp;
        if ($email == '') {
            return response()->json([
                'status' => false,
                'msg' => 'OTP not match',
            ]);
        }

        $userDetails = Customer::where('email', $email)->first();

        if ($otp == $userDetails->forgotpassword_code) {
            return response()->json([
                'status' => true,
                'msg' => 'OTP matched',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'OTP not match',
            ]);
        }
    }

    public function change_password()
    {
        $email = Session::get('user_email');
        if ($email == '') {
            return redirect()->route('signin');
        }
        return view('frontend::change_password');
    }

    public function submit_change_password(Request $request)
    {
        $email = Session::get('user_email');
        if ($email == '') {
             return redirect()->route('signin');
        }
        $request->validate([
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password',
        ]);


        $user = Customer::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $result = $user->save();

        if ($result) {
            // Session::forget('user_email');
            session()->forget('user_email');
            return redirect()->back()->with('success', 'Password changed successfully')->with('redirect_login', true);
        } else {
            return redirect()->back()->withInput()->with('error', 'Something went wrong!');
        }
    }

    public function register()
    {
        $cachedData = Cache::get('cached_customer_data');
        return view('frontend::register', compact('cachedData'));
    }

    
    public function advertising(Request $request)
    {
        $data['advertising'] = Advertising::first();
        return view('frontend::advertising', $data);
    }
    public function about_us()
    {
        $data['aboutus']=Aboutus::first();
        return view('frontend::about_us', $data);
    }
    public function contact_us()
    {
        $data['contactus'] = Contactuscms::first();
        return view('frontend::contact_us', $data);
    }

    public function seller_listing($id)
    {
        $decoded = base64_decode($id);

        if (!is_numeric($decoded)) {
            abort(404, 'Invalid Seller ID');
        }

        $customerId = (int)$decoded;

        $customer = Customer::with('subscriptions')->findOrFail($customerId);

        $today = \Carbon\Carbon::today();
        $isAllowed = false;

        if ($customer->is_free) {
            $isAllowed = true;
        } else {
            $activeSubscription = $customer->subscriptions()
                ->where('status', 'active')
                ->where('start_date', '<=', $today)
                ->where('end_date', '>=', $today)
                ->exists();

            if ($activeSubscription) {
                $isAllowed = true;
            }
        }

        if (!$isAllowed) {
            // Optional: redirect or abort if not allowed
            abort(403, 'This seller does not have an active subscription.');
        }

        // Get only published and approved equipments from this seller
        $equipments = Equipment::published()
            ->approved()
            ->where('customer_id', $customerId);

        $data['allEquipments'] = $equipments->orderBy('id', 'desc')->paginate(9)->withQueryString();

        return view('frontend::seller_listing', $data);
    }
    public function products(Request $request)
    {
        $category =null;
        $catQuery = Category::with('childs')->where('parent_id',0)->get();
        if(count($catQuery) > 0)
        {
            foreach($catQuery as $key => $value)
            {
                $subcategory =null;
                if(count($value->childs) > 0)
                {
                    foreach($value->childs as $child)
                    {
                        $subcategory[] = array(
                            'id' => $child->id,
                            'name'=> $child->name
                        );
                    }
                }
                $category[] = array(
                    'id' => $value->id,
                    'name'=> $value->name,
                    'subcategory' => $subcategory
                );
                
            }
        }
        $data['allCategory'] = $category;

        $equipments = Equipment::published()->approved()
                ->whereHas('customer', function ($query) {
                    $query->where('is_free', true)
                        ->orWhere(function ($q) {
                            $today = \Carbon\Carbon::today();
                            $q->where('is_free', false)
                                ->whereHas('subscriptions', function ($sub) use ($today) {
                                    $sub->where('status', 'active')
                                        ->where('start_date', '<=', $today)
                                        ->where('end_date', '>=', $today);
                                });
                        });
                });

            // Filter by category
            if ($request->filled('category')) {
                $categoryQuery = Category::find($request->category);
                if($categoryQuery->parent_id == 0)
                {
                    $categoryIds = Category::where('parent_id',$request->category)->pluck('id');
                    $equipments->whereIn('category_id', $categoryIds);
                }
                else
                {
                    $equipments->where('category_id', $request->category);
                }
                
            }

            // Filter by name
            if ($request->filled('name')) {
                $equipments->where('name', 'like', '%' . $request->name . '%');
                $data['search_keyword'] = $request->name;
            }

            // Filter by manufacturer
            if ($request->filled('manufacturer_id')) {
                $equipments->where('manufacturer_id', $request->manufacturer_id);
            }

            // Filter by model
            if ($request->filled('equipment_model_id')) {
                $equipments->where('equipment_model_id', $request->equipment_model_id);
            }

            // Final query execution
            $data['allEquipments'] = $equipments
                ->with('customer') // Optional: eager load customer
                ->orderBy('id', 'desc')
                ->paginate(9)
                ->withQueryString();

        return view('frontend::products', $data);
    }
    public function product_details($slug)
    {
        $today = \Carbon\Carbon::today();

        $equipment = Equipment::with(['customer.subscriptions'])
            ->where('slug', $slug)
            ->whereHas('customer', function ($query) use ($today) {
                $query->where('is_free', true)
                    ->orWhere(function ($q) use ($today) {
                        $q->where('is_free', false)
                            ->whereHas('subscriptions', function ($sub) use ($today) {
                                $sub->where('status', 'active')
                                    ->where('start_date', '<=', $today)
                                    ->where('end_date', '>=', $today);
                            });
                    });
            })
            ->approved()->published()
            ->first();

        // Optional: handle if equipment is not accessible
        if (!$equipment) {
           abort(403);
        }
        $data['equipment'] = $equipment;


        $recommendedList = Equipment::published()->approved() // Optional: add if needed
            ->where('category_id', $equipment->category_id)
            ->where('id', '!=', $equipment->id)
            ->whereHas('customer', function ($query) use ($today) {
                $query->where('is_free', true)
                    ->orWhere(function ($q) use ($today) {
                        $q->where('is_free', false)
                            ->whereHas('subscriptions', function ($sub) use ($today) {
                                $sub->where('status', 'active')
                                    ->where('start_date', '<=', $today)
                                    ->where('end_date', '>=', $today);
                            });
                    });
            })
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();
        $data['recommendedList'] = $recommendedList;

        //Watchlist Section Start
        $isFavorite = false;
        if(Auth::guard('customer')->check())
        {
            $customer = Auth::guard('customer')->user();
            if ($customer) {
            $isFavorite = Watchlist::where('customer_id', $customer->id)
                    ->where('equipment_id', $equipment->id)
                    ->exists();
            }
        }
        $data['isFavorite'] = $isFavorite;
        //Watchlist Section End

        return view('frontend::product_details', $data);
    }

    public function watchlist(Request $request)
    {
        $data = array();
        $data['allEquipments'] = array();
        if (Auth::guard('customer')->check()) {
            $customerId = Auth::guard('customer')->user()->id;
            $equipment_ids = Watchlist::where('customer_id',$customerId)->pluck('equipment_id');
            $equipments = Equipment::published()->approved();

            if(!empty($equipment_ids))
            {
                $equipments->whereIn('id',$equipment_ids);
            }
            $data['allEquipments'] = $equipments->orderBy('id', 'desc')->paginate(9)->withQueryString();
        }
        
        return view('frontend::watchlists', $data);
    }
    public function watchlist_toggle(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $customerId = Auth::guard('customer')->user()->id;
        $equipmentId = $request->input('equipment_id');

        $existing = Watchlist::where('customer_id', $customerId)
            ->where('equipment_id', $equipmentId)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Watchlist::create([
                'customer_id' => $customerId,
                'equipment_id' => $equipmentId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function watchlist_item_remove(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['status' => 'unauthenticated']);
        }

        $customerId = Auth::guard('customer')->user()->id;
        $equipmentId = $request->input('equipment_id');

        $existing = Watchlist::where('customer_id', $customerId)
            ->where('equipment_id', $equipmentId)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'removed']);
        } 
        return response()->json(['status' => 'error']);
    }

    public function submit_equipment_enquiry(Request $request) {

       try {
            $validated = $request->validate([
                'first_name'       => 'required|string|max:100',
                'last_name'        => 'required|string|max:100',
                'email'            => 'required|email|max:100',
                'phone'            => ['required', new PhoneNumber()],
                'postal_code'      => 'required|string|max:5',
                'message'          => 'required|string',
                'marketing_opt_in' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Something went wrong!');
        }

       $isExist = Equipment::where('id',$request->equipment_id)->exists();
       if(!$isExist)
       {
            return redirect()->back()->withInput()->with('error','Something went wrong!');
       }

       $input = $request->all();
       $input['marketing_opt_in'] = $request->marketing_opt_in ? 'Yes' : 'No';
       $result = EquipmentEnquiry::create($input);
        if($result)
        {
            $equipment = Equipment::find($request->equipment_id);
            $seller_email = $equipment->customer->email ?? '';
            if($seller_email != '')
            {
                Mail::to($seller_email)->send(new SendEnquiryMail($validated));
            }
            
            return redirect()->back()->with('success','Thank you! we will contact you soon.');
        }
        else
        {
            return redirect()->back()->withInput()->with('error','Something went wrong!');
        }
       
    }
    

    public function submit_register(Request $request)
    {
       $validatedData = $request->validate([
        'first_name'=> 'required|string|max:100',
        'last_name'=> 'required|string|max:100',
        'email'=> 'required|email|max:100|unique:customers,email',
        'phone' => ['required', new PhoneNumber()],
        'address'=> 'required|string|max:255',
        'city'=> 'required|string|max:100',
        'state'=> 'required|string|max:100',
        'country'=> 'required|string|max:100',
        'postal_code'=> 'required|string|max:5',
        'password'=> 'required|string|same:repassword',
        
       ]);


       $input = $request->all();

       if($request->role === 'Buyer')
       {
            $input['role']="buyer";
            $input["password"]= Hash::make($request->password);
            $result = Customer::create($input);
            if($result)
            {
                $name = $request->first_name." ".$request->last_name;
                Mail::to($request->email)->send(new WelcomeMail($name, route('signin')));
                return redirect()->route('success')->with('success','You have registered successfully.');
            }
            else
            {
                return redirect()->route('oops')->with('error','Something went wrong!');
            }
       }
       else
       {
            $request->validate([
                'documents' => 'required', // optional: ensure at least one file is uploaded
                'documents.*' => 'required|mimes:jpeg,jpg,pdf|max:1024', // 1MB per file
            ]);
            $uploadedFiles = [];

            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $ext = $file->getClientOriginalExtension(); // jpg, pdf
                    $type = $ext === 'pdf' ? 'pdf' : 'image';
                    $timestamp = Carbon::now()->format('Y_m_d_His');
                    $random = Str::random(6);
                    $filename = $timestamp . '_' . $random . '.' . $ext;

                    // Ensure folder exists
                    $destinationPath = public_path('uploads/tempCustomerDoc');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    $file->move($destinationPath, $filename);

                    $uploadedFiles[] = [
                        'file' => 'uploads/tempCustomerDoc/' . $filename,
                        'type' => $type,
                        'original_name' => $file->getClientOriginalName(),
                    ];
                }
            }

            // Add uploaded file data to the rest of validatedData
            $validatedData['documents'] = $uploadedFiles;

            // Cache for 120 minutes (7200 seconds)
            Cache::put('cached_customer_data', $validatedData, 7200);

            return redirect()->route('subscription');

           
       }



       
    }
    public function subscription(Request $request)
    {
        // $data = Cache::get('cached_customer_data');
        // if (!$data) {
        //     return redirect()->route('register');
        // } 


        $data['subscriptionplan']=Subscriptionplan::active()->get();
        return view('frontend::subscription', $data);
    }

    //Paypal Integration
    public function startPayment(Request $request)
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

        return redirect()->route('subscription_booking');
    }

    public function subscription_booking(Request $request)
    {
        $total_amount = session('subscription.price');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('subscription_success'),
                "cancel_url" => route('subscription_cancel')
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

        return redirect()->route('subscription_cancel');
    }

    public function subscription_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if ($response['status'] === 'COMPLETED') {
            $payment_id = $request->token;
            $newStatus = $this->complete_subscription($payment_id);
            if($newStatus == true)
            {
                return redirect()->route('success')->with('success','You have registered successfully.');
            }
            else
            {
                 return redirect()->route('oops')->with('error','Something went wrong!');
            }
            
        }

        return redirect()->route('oops')->with('error','Something went wrong!');
    }

    public function complete_subscription($payment_id)
    {
        $subscription = session('subscription');

        DB::beginTransaction();
        try {
            //code...
            // Example: $data['email'], $data['first_name'], etc.
            $data = Cache::get('cached_customer_data');

            // Create permanent document folder
            $permanentPath = public_path('uploads/customerDoc');
            if (!file_exists($permanentPath)) {
                mkdir($permanentPath, 0755, true);
            }

            // Move each document
            $movedFiles = [];
            foreach ($data['documents'] as $doc) {
                $tempFilePath = public_path($doc['file']);
                $fileName = basename($doc['file']);

                $newPath = $permanentPath . '/' . $fileName;
                if (file_exists($tempFilePath)) {
                    rename($tempFilePath, $newPath); // Move from temp to permanent
                }

                $movedFiles[] = [
                    'file' => $fileName,
                    'type' => $doc['type'],
                ];
            }

            // Replace temp paths with final paths
            $data['documents'] = $movedFiles;
            


            // Customer Create Section
            $data['role']="seller";
            $data['password'] = Hash::make($data['password']);
            $customer = Customer::create($data);
            // Customer Create Section


            //Document Upload Section
            foreach ($data['documents'] as $doc) {
                CustomerDocument::create([
                    'customer_id' => $customer->id,
                    'file' => $doc['file'],
                    'type' => $doc['type'],
                ]);
            }
            //Document Upload Section

            $subscriptionData = [
                'customer_id' => $customer->id,
                'subscription_plan_id' => $subscription['id'],
                'start_date' => $subscription['start_date'],
                'end_date' => $subscription['end_date'], // could be null for free
                'type' => $subscription['type'],
                'amount' => $subscription['price'],
                'txn_id' => $payment_id,
                'payment_type' => 'online',
            ];

            $createdSubscription = Subscription::create($subscriptionData);

            $name = $data['first_name']." ".$data['last_name'];
            Mail::to($data['email'])->send(new WelcomeMail($name, route('signin')));

            session()->forget(['subscription']);
            Cache::forget('cached_customer_data');

            DB::commit();

            return true;
        } catch (\Throwable $th) {
            //throw $th;
            Cache::forget('cached_customer_data');
            DB::rollBack();
            return false;
        }
          
    }

    public function subscription_cancel(Request $request)
    {
        return redirect()->route('oops');
    }

    public function success()
    {
        return view('frontend::success');
    }
    public function oops()
    {
        return view('frontend::error');
    }
}
