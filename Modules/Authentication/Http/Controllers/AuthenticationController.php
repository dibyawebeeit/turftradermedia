<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ForgotpasswordMail;

use App\Models\User; // Import the User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard.index');
        }
        return view('authentication::index');
    }

    
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

    public function forgot_password(Request $request)
    {
        return view('authentication::forgot_password');
    }

    public function submit_forgot_password(Request $request)
    {
        $email = $request->email;
        $isExist = User::where('email', $email)->exists();

        if ($isExist) {
            $otp = rand(111111, 999999);

            $mailData = array(
                'otp' => $otp
            );
            Mail::to($email)->send(new ForgotpasswordMail($mailData));

            Session::put('user_email', $email);
            $user = User::where('email', $email)->first();
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

        $userDetails = User::where('email', $email)->first();

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
            return redirect()->route('authentication.index');
        }
        return view('authentication::change_password');
    }

    public function submit_change_password(Request $request)
    {
        $email = Session::get('user_email');
        if ($email == '') {
            return redirect('/login');
        }
        $request->validate([
            'password' => 'required|string',
            'confirm_password' => 'required|string|same:password',
        ]);


        $user = User::where('email', $email)->first();
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
    

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('authentication.index');
    }
}
