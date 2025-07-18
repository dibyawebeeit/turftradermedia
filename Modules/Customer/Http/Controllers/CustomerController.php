<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Banner\Models\Banner;
use Modules\Customer\Models\Customer;
use Pest\ArchPresets\Custom;

class CustomerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:customer_list|customer_add|customer_edit|customer_delete|customer_view', ['only' => ['index','store']]);
         $this->middleware('permission:customer_add', ['only' => ['create','store']]);
         $this->middleware('permission:customer_view', ['only' => ['show']]);
         $this->middleware('permission:customer_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customer_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['dataList'] = Customer::orderBy('id', 'desc')->get();
        return view('customer::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer::create');
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
        $customer = Customer::findOrFail($id);
        $data['customer'] = $customer;
        return view('customer::show' ,$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Customer::findOrFail($id);
        return view('customer::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
        'first_name'=> 'required|string|max:100',
        'last_name'=> 'required|string|max:100',
        'email'=> 'required|email|max:100|unique:customers,email,'.$id,
        'phone' => ['required', new PhoneNumber()],
        'address'=> 'required|string|max:255',
        'city'=> 'required|string|max:100',
        'state'=> 'required|string|max:100',
        'country'=> 'required|string|max:100',
        'postal_code'=> 'required|string|max:5',
       ]);

        $data = Customer::findOrFail($id);
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
            $imagePath = public_path('uploads/customerDoc/' . $data->image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['image'] = $imageName;
        } 

        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('customer.index')->with('success', 'Customer updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = Customer::findOrFail($id);
        $result = $data->delete();
        if ($result) {
            return redirect()->route('banner.index')->with('success', 'Banner deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
