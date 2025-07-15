<?php

namespace Modules\EquipmentModel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\EquipmentModel\Models\EquipmentModel;
use Modules\Manufacturer\Models\Manufacturer;

class EquipmentModelController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:equipmentmodel_list|equipmentmodel_add|equipmentmodel_edit|equipmentmodel_delete', ['only' => ['index','store']]);
         $this->middleware('permission:equipmentmodel_add', ['only' => ['create','store']]);
         $this->middleware('permission:equipmentmodel_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:equipmentmodel_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['dataList'] = EquipmentModel::orderBy('id', 'desc')->get();
        return view('equipmentmodel::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['manufacturerList'] = Manufacturer::active()->get();
        return view('equipmentmodel::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'manufacturer_id'=> 'required',
            'name' => 'required|string|max:255|unique:equipment_models,name',
        ]);

        $input = $request->all();
        $input['slug']= Str::slug($request->name,'-');
        $input['status'] = $request->status ? 1 : 0;
        $result = EquipmentModel::create($input);
        if ($result) {
            return redirect()->route('equipmentmodel.index')->with('success', 'Model added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('equipmentmodel::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = EquipmentModel::findOrFail($id);
        $data['manufacturerList'] = Manufacturer::get();
        return view('equipmentmodel::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'manufacturer_id'=> 'required',
            'name' => 'required|string|max:255|unique:manufacturers,name,'. $id,
        ]);

        $data = EquipmentModel::findOrFail($id);
        $input = $request->all();

        $input['slug']= Str::slug($request->name,'-');
        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('equipmentmodel.index')->with('success', 'Model updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = EquipmentModel::findOrfail($id);
        $result = $data->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Model deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
