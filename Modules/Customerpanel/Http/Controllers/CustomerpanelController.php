<?php

namespace Modules\Customerpanel\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Watchlist;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Customer\Models\Customer;
use Modules\Customer\Models\CustomerDocument;
use Modules\Equipment\Models\Equipment;
use Modules\EquipmentEnquiry\Models\EquipmentEnquiry;
use Pest\ArchPresets\Custom;

class CustomerpanelController extends Controller
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
        $this->activemenu = "dashboard";
        $data['activemenu'] = $this->activemenu;

        $data['total_watchlist'] = Watchlist::where('customer_id',$this->activeCustomerId)->count();
        $data['total_enquiry'] =0;
        
        if (Auth::guard('customer')->user()->role === 'seller')
        {
            $data['total_equipment'] = Equipment::where('customer_id', $this->activeCustomerId)->count();

            $equipmentIds = Equipment::where('customer_id', $this->activeCustomerId)->pluck('id');
            if(!empty($equipmentIds))
            {
                $data['total_enquiry'] = EquipmentEnquiry::whereIn('equipment_id',$equipmentIds)->count();
            }
            
        }


        return view('customerpanel::index', $data);
    }

    public function enquiry()
    {
        $this->activemenu = "enquiry";
        $data['activemenu'] = $this->activemenu;

        $data['enquiryList'] = array();
        $equipmentIds = Equipment::where('customer_id', $this->activeCustomerId)->pluck('id');
        if(!empty($equipmentIds))
        {
            $data['enquiryList'] = EquipmentEnquiry::whereIn('equipment_id',$equipmentIds)->get();
        }
        

        return view('customerpanel::enquiry', $data);
    }

    public function view_enquiry($id) {
        $this->activemenu = "enquiry";
        $data['activemenu'] = $this->activemenu;
        
        $enquiry = EquipmentEnquiry::findOrFail($id);

        $isExist = Equipment::where('customer_id',$this->activeCustomerId)->where('id',$enquiry->equipment_id)->exists();
        if(!$isExist)
        {
            abort(403);
        }

        $data['enquiry']=$enquiry;
        return view('customerpanel::view_enquiry', $data);

    }
    public function profile_setting()
    {
        $this->activemenu = "profile_setting";
        $data['activemenu'] = $this->activemenu;

        $data['profile'] = Auth::guard('customer')->user();
        return view('customerpanel::profile_setting', $data);
    }
    public function update_profile(Request $request)
    {
        $id = $this->activeCustomerId;
        $request->validate([
        'first_name'=> 'required|string|max:100',
        'last_name'=> 'required|string|max:100',
        'email'=> 'required|email|max:100|unique:customers,email,'. $id,
        'phone' => ['required', new PhoneNumber()],
        'address'=> 'required|string|max:255',
        'city'=> 'required|string|max:100',
        'state'=> 'required|string|max:100',
        'country'=> 'required|string|max:100',
        'postal_code'=> 'required|string|max:5',
       ]);

       $customer = Customer::find($id);
       $input = $request->all();

        if ($request->has('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/customerDoc');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/customerDoc/' . $customer->image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['image'] = $imageName;
        }
        
       $result = $customer->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }

    }

    public function change_password()
    {
        $this->activemenu = "change_password";
        $data['activemenu'] = $this->activemenu;

        return view('customerpanel::change_password', $data);
    }

    public function update_password(Request $request)
    {
        $id = $this->activeCustomerId;
        $request->validate([
            'old_password'=>'required|string',
            'password'=> 'required|string|max:100',
            'confirm_password'=> 'required|string|max:100|same:password',
        ]);

        $customer = Customer::find($id);
        if(Hash::check($request->old_password, $customer->password))
        {
            $customer->password=Hash::make($request->password);
            $result = $customer->save();
    
            if($result){
                return redirect()->back()->with('success', 'Password changed successfully');
            }
            else{
                return redirect()->back()->withInput()->with('error', 'Something went wrong!');
            }
        }
        else
        {
            return redirect()->back()->withInput()->with('error', 'Old password not matched!');
        }

       
    }

    public function business_document() {
        $this->activemenu = "business_document";
        $data['activemenu'] = $this->activemenu;

        $data['documentsList'] = Customer::with('documents')->where('id',$this->activeCustomerId)->first();
        return view('customerpanel::business_document', $data);
    }

    public function upload_document(Request $request)
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
                $destinationPath = public_path('uploads/customerDoc');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);

                $uploadedFiles[] = [
                    'file' => $filename,
                    'type' => $type,
                    'original_name' => $file->getClientOriginalName(),
                ];
            }
        }

        //Document Upload Section
        foreach ($uploadedFiles as $doc) {
            CustomerDocument::create([
                'customer_id' => $this->activeCustomerId,
                'file' => $doc['file'],
                'type' => $doc['type'],
            ]);
        }
        //Document Upload Section
        return redirect()->back()->with('success', 'Document uploaded successfully');
    }

    public function delete_document(Request $request)
    {
        $id = $request->input('id');
        $data = CustomerDocument::where('customer_id',$this->activeCustomerId)->find($id);
        if ($data) {
            // Check if the file exists and delete it
            $imagePath = public_path('uploads/customerDoc/' . $data->file);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $data->delete();
            return response()->json(['success' => true, 'message' => 'Document deleted successfully.']);
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Something went wrong!.']);
        }

        
    }
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('signin');
    }
    
}
