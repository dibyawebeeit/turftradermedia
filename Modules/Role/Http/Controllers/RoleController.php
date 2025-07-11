<?php

namespace Modules\Role\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role');
    }
    public function index()
    {
        $data['dataList']=Role::get();
        return view('role::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:roles',
        ]);

        $input= $request->all();
        $result = Role::create($input);
        if($result)
        {
            return redirect()->back()->with('success','Role added successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $data['dataList']=Role::findOrFail($id);
        return view('role::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id,
        ]);

        $data = Role::find($id);
        $input= $request->all();
        $result = $data->update($input);
        if($result)
        {
            return redirect()->back()->with('success','Role updated successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isExist = User::where('role',$id)->exists();
        if($isExist)
        {
            return redirect()->back()->with('error','you can not delete this because user already exist in this role');
        }
        else
        {
            Role::where('id',$id)->delete();
            return redirect()->back()->with('success','Role deleted successfully');
        }
    }
}
