<?php

namespace Modules\Banner\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Banner\Models\Banner;

class BannerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:banner_list|banner_add|banner_edit|banner_delete', ['only' => ['index','store']]);
         $this->middleware('permission:banner_add', ['only' => ['create','store']]);
         $this->middleware('permission:banner_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:banner_delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data['dataList'] = Banner::orderBy('id', 'desc')->get();
        return view('banner::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banner::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $input = $request->all();

        if ($request->has('image')) {
            
            $image = $request->file('image');
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('uploads/bannerImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);
            $input['image'] = $imageName;
        } 

        
        $input['status'] = $request->status ? 1 : 0;
        $result = Banner::create($input);
        if ($result) {
            return redirect()->route('banner.index')->with('success', 'Banner added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('banner::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Banner::findOrFail($id);
        return view('banner::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
        ]);

        $data = Banner::findOrFail($id);
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
            $uploadPath = public_path('uploads/bannerImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/bannerImage/' . $data->image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['image'] = $imageName;
        } 

        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('banner.index')->with('success', 'Banner updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = Banner::findOrFail($id);

        // Check if the file exists and delete it
        $imagePath = public_path('uploads/bannerImage/' . $data->image);
        if (File::exists($imagePath)) {
            // Delete the file
            File::delete($imagePath);
        }

        $result = $data->delete();
        if ($result) {
            return redirect()->route('banner.index')->with('success', 'Banner deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
