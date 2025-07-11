<?php

namespace Modules\Subscriptionplan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Subscriptionplan\Models\Subscriptionplan;

class SubscriptionplanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:subscriptionplan_list|subscriptionplan_add|subscriptionplan_edit|subscriptionplan_delete', ['only' => ['index','store']]);
         $this->middleware('permission:subscriptionplan_add', ['only' => ['create','store']]);
         $this->middleware('permission:subscriptionplan_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:subscriptionplan_delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data['dataList'] = Subscriptionplan::orderBy('id', 'desc')->get();
        return view('subscriptionplan::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscriptionplan::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'monthly_price' => 'required',
            'annual_price' => 'required',
            'description' => 'required',
            'offer' => 'nullable',
        ]);

        $input = $request->all();

        $input['status'] = $request->status ? 1 : 0;
        $result = Subscriptionplan::create($input);
        if ($result) {
            return redirect()->route('subscriptionplan.index')->with('success', 'Subscription Plan added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('subscriptionplan::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Subscriptionplan::findOrFail($id);
        return view('subscriptionplan::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'monthly_price' => 'required',
            'annual_price' => 'required',
            'description' => 'required',
            'offer' => 'nullable',
        ]);

        $data = Subscriptionplan::findOrFail($id);
        $input = $request->all();

        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('subscriptionplan.index')->with('success', 'Subscription Plan updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = Subscriptionplan::findOrFail($id);
        $result = $data->delete();
        if ($result) {
            return redirect()->route('subscriptionplan.index')->with('success', 'Subscription Plan deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
