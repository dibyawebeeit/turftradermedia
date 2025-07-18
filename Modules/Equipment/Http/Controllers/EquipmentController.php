<?php

namespace Modules\Equipment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Equipment\Models\Equipment;

class EquipmentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:equipment_list|equipment_add|equipment_edit|equipment_delete|equipment_view', ['only' => ['index','store']]);
         $this->middleware('permission:equipment_add', ['only' => ['create','store']]);
         $this->middleware('permission:equipment_view', ['only' => ['show']]);
         $this->middleware('permission:equipment_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:equipment_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['dataList'] = Equipment::orderBy('id', 'desc')->get();
        return view('equipment::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipment::create');
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
        $data['equipment'] = Equipment::findOrFail($id);
        return view('equipment::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Equipment::findOrFail($id);
        return view('equipment::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
