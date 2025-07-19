<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Cms\Models\Aboutus;
use Modules\Cms\Models\Advertising;
use Modules\Cms\Models\Contactuscms;
use Modules\Cms\Models\Home;
use Modules\Cms\Models\Termsconditions;

class CmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cms');
    }

    public function home(Request $request) {
        $data['dataList'] = Home::first();

        return view('cms::home',$data);
    }

    public function submit_home(Request $request) {
        $validated = $request->validate([
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'section1_title' => 'required|string|max:255',
            'section1_title2' => 'nullable|string|max:255',
            'section1_button_text' => 'required|string|max:255',
            'section1_button_url' => 'required|string|max:255',
            'section2_title' => 'required|string|max:255',
            'section2_title2' => 'nullable|string|max:255',
            'section2_title3' => 'nullable|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);

        $data = Home::first();
        $input = $request->all();

        if ($request->has('banner')) {
            $validated = $request->validate([
                'banner' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('banner');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->banner);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['banner'] = $imageName;
        } 

        if ($request->has('section1_image')) {
            $validated = $request->validate([
                'section1_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('section1_image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->section1_image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['section1_image'] = $imageName;
        }

        if ($request->has('section2_image')) {
            $validated = $request->validate([
                'section2_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('section2_image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->section2_image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['section2_image'] = $imageName;
        }
    

        $result = $data->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'Home updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    public function about_us(Request $request) {
        $data['dataList'] = Aboutus::first();

        return view('cms::about_us',$data);
    }

    public function submit_about_us(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'desc' => 'required|string',
            'section1_title' => 'required|string|max:255',
            'section1_title2' => 'nullable|string|max:255',
            'section1_button_text' => 'required|string|max:255',
            'section1_button_url' => 'required|string|max:255',
            'section2_title' => 'required|string|max:255',
            'section2_title2' => 'nullable|string|max:255',
            'section2_title3' => 'nullable|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);

        $data = Aboutus::first();
        $input = $request->all();

        if ($request->has('banner')) {
            $validated = $request->validate([
                'banner' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('banner');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->banner);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['banner'] = $imageName;
        } 

        if ($request->has('section1_image')) {
            $validated = $request->validate([
                'section1_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('section1_image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->section1_image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['section1_image'] = $imageName;
        }

        if ($request->has('section2_image')) {
            $validated = $request->validate([
                'section2_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('section2_image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->section2_image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['section2_image'] = $imageName;
        }
    

        $result = $data->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'About Us updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    public function advertising(Request $request) {
        $data['dataList'] = Advertising::first();

        return view('cms::advertising',$data);
    }

    public function submit_advertising(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title2' => 'nullable|string|max:255',
            'desc' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|string|max:100',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);

        $data = Advertising::first();
        $input = $request->all();

        if ($request->has('banner')) {
            $validated = $request->validate([
                'banner' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('banner');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->banner);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['banner'] = $imageName;
        } 

    

        $result = $data->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'Advertising updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    public function contact_us(Request $request) {
        $data['dataList'] = Contactuscms::first();

        return view('cms::contact_us',$data);
    }

    public function submit_contact_us(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title2' => 'nullable|string|max:255',
            'desc' => 'required|string',
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|string|max:100',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);

        $data = Contactuscms::first();
        $input = $request->all();

        if ($request->has('banner')) {
            $validated = $request->validate([
                'banner' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('banner');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/cmsImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/cmsImage/' . $data->banner);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['banner'] = $imageName;
        } 

    

        $result = $data->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'Conatact Us updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    public function terms_conditions(Request $request) {
        $data['dataList'] = Termsconditions::first();

        return view('cms::terms_conditions',$data);
    }

    public function submit_terms_conditions(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title2' => 'nullable|string|max:255',
            'desc' => 'required|string',
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);

        $data = Termsconditions::first();
        $input = $request->all();

        $result = $data->update($input);
        if ($result) {
            return redirect()->back()->with('success', 'Data updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }
}
