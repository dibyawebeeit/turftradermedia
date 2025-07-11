<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user_list|user_add|user_edit|user_delete', ['only' => ['index','store']]);
         $this->middleware('permission:user_add', ['only' => ['create','store']]);
         $this->middleware('permission:user_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user_delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data['dataList'] = User::with('roleName')->orderBy('id', 'desc')->get();
        return view('user::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roleList'] = Role::orderBy('id','asc')->get();
        return view('user::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|same:confirm_password',
            'role'=>'required'
        ]);

        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $result = User::create($input);
        if ($result) {

            // Role set 
            $user = User::find($result->id);
            $role = Role::find($request->role);
            $user->assignRole($role);

            return redirect()->route('user.index')->with('success', 'User added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['roleList'] = Role::orderBy('id','asc')->get();
        $data['dataList'] =User::findOrfail($id);
        return view('user::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users,email,'.$id,
            'role'=>'required'
        ]);

        $data = User::findOrfail($id);

        $input = $request->all();
        $input['status'] = $request->status ? 1 : 0;
        $result =$data->update($input);
        if ($result) {

            // Role set 
            $user = User::find($id);
            $role = Role::find($request->role);
            $user->assignRole($role);

            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = User::findOrfail($id);
        $result = $data->delete();
        if ($result) {
            return redirect()->route('user.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
