<?php

namespace Modules\Manufacturer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Manufacturer\Models\Manufacturer;

class ManufacturerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manufacturer_list|manufacturer_add|manufacturer_edit|manufacturer_delete', ['only' => ['index','store']]);
         $this->middleware('permission:manufacturer_add', ['only' => ['create','store']]);
         $this->middleware('permission:manufacturer_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manufacturer_delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data['dataList'] = Manufacturer::orderBy('id', 'desc')->get();
        return view('manufacturer::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manufacturer::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:manufacturers,name',
        ]);

        $input = $request->all();
        $input['slug']= Str::slug($request->name,'-');
        $input['status'] = $request->status ? 1 : 0;
        $result = Manufacturer::create($input);
        if ($result) {
            return redirect()->route('manufacturer.index')->with('success', 'Manufacturer added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('manufacturer::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Manufacturer::findOrFail($id);
        return view('manufacturer::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255|unique:manufacturers,name,'. $id,
        ]);

        $data = Manufacturer::findOrFail($id);
        $input = $request->all();

        $input['slug']= Str::slug($request->name,'-');
        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('manufacturer.index')->with('success', 'Manufacturer updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = Manufacturer::findOrfail($id);
        $result = $data->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Manufacturer deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
