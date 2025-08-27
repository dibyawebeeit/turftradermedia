<?php

namespace Modules\Ads\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Ads\Models\Ads;

class AdsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ads_list|ads_add|ads_edit|ads_delete', ['only' => ['index','store']]);
         $this->middleware('permission:ads_add', ['only' => ['create','store']]);
         $this->middleware('permission:ads_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:ads_delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data['dataList'] = Ads::orderBy('id', 'desc')->get();
        return view('ads::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ads::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'type' => 'required|string|max:20',
            'external_link' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $input = $request->all();

        if ($request->has('image')) {
            
            $image = $request->file('image');
            $imageName = 'ad_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('uploads/adsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);
            $input['image'] = $imageName;
        } 

        
        $input['status'] = $request->status ? 1 : 0;
        $result = Ads::create($input);
        if ($result) {
            return redirect()->route('ads.index')->with('success', 'Ad added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ads::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Ads::findOrFail($id);
        return view('ads::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'type' => 'required|string|max:20',
            'external_link' => 'required|string|max:255',
        ]);

        $data = Ads::findOrFail($id);
        $input = $request->all();

        if ($request->has('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            // Get the uploaded image
            $image = $request->file('image');

            // Create a custom file name
            $imageName = 'ad_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/adsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/adsImage/' . $data->image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['image'] = $imageName;
        } 

        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('ads.index')->with('success', 'Ad updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
         $data = Ads::findOrFail($id);

        // Check if the file exists and delete it
        $imagePath = public_path('uploads/adsImage/' . $data->image);
        if (File::exists($imagePath)) {
            // Delete the file
            File::delete($imagePath);
        }

        $result = $data->delete();
        if ($result) {
            return redirect()->route('ads.index')->with('success', 'Ad deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
