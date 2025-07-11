<?php

namespace Modules\Profile\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile::create');
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
        return view('profile::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('profile::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if($id != Auth::user()->id)
        {
            abort(401);
        }
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required|string',
            'phone' => 'nullable|numeric|digits:10',
        ]);

        if($request->has('image'))
        {
            $validated = $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) .time(). '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/userImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/userImage/' . $request->oldimage);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }
            
        }
        else
        {
            $imageName=$request->oldimage;
        }

        if($request->password!=null)
        {
            $validated = $request->validate([
                'password' => 'required|same:confirm-password',
            ]);
            $passowrd = Hash::make($request->password);
        }
        else
        {
            $passowrd = Auth::user()->password;
        }
        
        $data=User::find($id);
        $input = $request->all();
        $input['image']=$imageName;
        $input['password']=$passowrd;
        

        $result = $data->update($input);
        if($result)
        {
            return redirect()->route('profile.index')->with('success','profile updated successfully');
        }
        else
        {
            return redirect()->route('profile.index')->with('error','something went wrong!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
