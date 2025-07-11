<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('authentication::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authentication::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        $remember = !empty($request->remember)?true:false;
        $result= Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'status'=>1],$remember);
        if($result)
        {
            // $user = User::find(Auth::guard('admin')->user()->id);
            // $role = Role::find(1);
            // $user->assignRole($role);

            // return redirect()->route('authentication.index')->with('success','Login successful');
            return redirect()->route('dashboard.index');
        }
        else
        {
            return redirect()->route('authentication.index')->withInput()->with('error','Invalid Credentials');
        }
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('authentication::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('authentication::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('authentication.index');
    }
}
