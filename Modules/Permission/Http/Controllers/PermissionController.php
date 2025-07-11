<?php

namespace Modules\Permission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Permission\Models\Rolehaspermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Middlewares\PermissionMiddleware;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permission');
    }
    public function index()
    {
        $roleList=array();
        $rolehaspermission=Rolehaspermission::all();
        $newArray = $rolehaspermission->pluck('role_id')->unique();
        foreach($newArray as $role)
        {
            $role = Role::find($role);
            $count = Rolehaspermission::where('role_id',$role->id)->count();
            $roleList[]=array(
                'id'=>$role->id,
                'name'=>$role->name,
                'total'=>$count
            );
        }
        $data['dataList']=$roleList;
        return view('permission::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionArray=array();
        $permissionList=array();
        $data['roleList']=Role::get();
        $permissions = Permission::all();
        $permissionQuery = $permissions->groupBy('group_id');
        foreach($permissionQuery as $permission)
        {
            foreach($permission as $value)
            {
                $permissionArray[]=array(
                    'id'=>$value->id,
                    'display'=>$value->display,
                );
            }
            $permissionList[]=$permissionArray;
            $permissionArray=array();
        }

        // dd($permissionList);
        $data['permissionList']=$permissionList;
        return view('permission::create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'role' => 'required|unique:role_has_permissions,role_id',
        ]);

        $role = Role::find($request->role);
        if($request->permission!=null)
        {
            $permission = Permission::whereIn('id',$request->permission)->get();
            $result =  $role->givePermissionTo($permission);
            if($result)
            {
                return redirect()->route('permission.index')->with('success','Permission added successfully');
            }
            else
            {
                return redirect()->back()->with('error','something went wrong!');
            }
        }
        else
        {
            return redirect()->back()->with('error','Nothing to add!');
        }
        
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('permission::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userPermissionList=array();
        $permissionArray=array();
        $permissionList=array();
        $data['roleList']=Role::get();
        $permissions = Permission::all();
        $permissionQuery = $permissions->groupBy('group_id');
        foreach($permissionQuery as $permission)
        {
            foreach($permission as $value)
            {
                $permissionArray[]=array(
                    'id'=>$value->id,
                    'display'=>$value->display,
                );
            }
            $permissionList[]=$permissionArray;
            $permissionArray=array();
        }

        // dd($permissionList);
        $data['permissionList']=$permissionList;
        $data['roleId']=$id;

        $data['userPermissionList']=array();
        $rolehasPermissionQuery = Rolehaspermission::select('permission_id')->where('role_id',$id)->get();
        if(!empty($rolehasPermissionQuery))
        {
            foreach($rolehasPermissionQuery as $permission)
            {
                $userPermissionList[]=$permission->permission_id;
            }
            $data['userPermissionList']= $userPermissionList;
        }
        
    
        return view('permission::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Rolehaspermission::where('role_id',$id)->delete();
        $role = Role::find($id);

        if($request->permissions!=null)
        {
            $permission = Permission::whereIn('id',$request->permissions)->get();

            $result =  $role->givePermissionTo($permission);
            if($result)
            {
                return redirect()->route('permission.index')->with('success','Permission updated successfully');
            }
            else
            {
                return redirect()->back()->with('error','something went wrong!');
            }
        }
        else
        {
            return redirect()->back()->with('error','Noting to update');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Rolehaspermission::where('role_id',$id)->delete();
        if($result)
        {
            return redirect()->back()->with('success','Permission deleted successfully');
        }
        else
        {
            return redirect()->back()->with('error','something went wrong!');
        }
    }
}
