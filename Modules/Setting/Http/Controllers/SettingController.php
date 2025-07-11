<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Setting\Models\Setting;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class SettingController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:banner-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:banner-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:banner-delete', ['only' => ['destroy']]);

        $this->middleware('permission:setting', ['only' => ['index','update']]);
    }
    public function index()
    {
        $data['dataList'] = Setting::first();
        return view('setting::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'contact_email' => 'required|email|max:100',
            'contact_no' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($request->has('logo')) {
            $validated = $request->validate([
                'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('logo');

            // Create a custom file name
            $logoimageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/siteImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $logoimageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/siteImage/' . $request->oldlogo);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }
        } else {
            $logoimageName = $request->oldlogo;
        }

        if ($request->has('favicon')) {
            $validated = $request->validate([
                'favicon' => 'required|mimes:jpg,jpeg,png,webp,ico,svg|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('favicon');

            // Create a custom file name
            $faviconimageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/siteImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $faviconimageName);




            // Check if the file exists and delete it
            $imagePath = public_path('uploads/siteImage/' . $request->oldfavicon);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }
        } else {
            $faviconimageName = $request->oldfavicon;
        }

        $data = Setting::find($id);
        $input = $request->all();
        $input['logo'] = $logoimageName;
        $input['favicon'] = $faviconimageName;
        $input['smtp_status'] = !empty($request->smtp_status) ? 1 : 0;
        $input['recapcha_status'] = !empty($request->recapcha_status) ? 1 : 0;
        $input['google_signin_status'] = !empty($request->google_signin_status) ? 1 : 0;
        $input['paypal_status'] = !empty($request->paypal_status) ? 1 : 0;
        $input['stripe_status'] = !empty($request->stripe_status) ? 1 : 0;
        $input['razorpay_status'] = !empty($request->razorpay_status) ? 1 : 0;
        $input['payu_status'] = !empty($request->payu_status) ? 1 : 0;


        $result = $data->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'setting updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
