<?php

namespace Modules\EquipmentEnquiry\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\EquipmentEnquiry\Models\EquipmentEnquiry;

class EquipmentEnquiryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:equipment_enquiry_list|equipment_enquiry_edit|equipment_enquiry_delete', ['only' => ['index']]);
         $this->middleware('permission:equipment_enquiry_edit', ['only' => ['show','edit','update']]);
         $this->middleware('permission:equipment_enquiry_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['dataList'] = EquipmentEnquiry::orderBy('id', 'desc')->get();
        return view('equipmentenquiry::index', $data);
    }

    
    public function show($id)
    {
        $enquiry = EquipmentEnquiry::findOrFail($id);
        $data['enquiry'] = $enquiry;
        return view('equipmentenquiry::show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('equipmentenquiry::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = EquipmentEnquiry::findOrFail($id);
        $result = $data->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Enquiry deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
