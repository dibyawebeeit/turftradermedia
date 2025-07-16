<?php

namespace Modules\Customerpanel\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Customer\Models\CustomerDocument;
use Modules\Equipment\Models\Equipment;
use Modules\Equipment\Models\EquipmentImage;
use Modules\EquipmentModel\Models\EquipmentModel;
use Modules\Manufacturer\Models\Manufacturer;
use App\Rules\PhoneNumber;

class CustomerEquipmentController extends Controller
{
    public $activemenu;
    public $activeCustomerId;

    public function __construct()
    {
        // Ensure middleware has already run
        $this->middleware(function ($request, $next) {
            if (Auth::guard('customer')->check()) {
                $this->activeCustomerId = Auth::guard('customer')->id();
            }

            return $next($request);
        });
    }
    
    public function index()
    {
        $this->activemenu = "equipment";
        $data['activemenu'] = $this->activemenu;

        $data['equipmentList'] = Equipment::with('currency')->where('customer_id',$this->activeCustomerId)->get();
        return view('customerpanel::equipment.index', $data);
    }

    public $categoryList = array();
    public function create()
    {
        $this->activemenu = "equipment";
        $data['activemenu'] = $this->activemenu;

        $data['currencyList'] = Currency::active()->get();
        $data['manufacturerList'] = Manufacturer::active()->get();

        $categoryQuery=Category::where('parent_id',0)->get();
        if(!empty($categoryQuery))
        {
            foreach ($categoryQuery as $category) {
                $this->getChildren($category,0);
            }
        }
        $data['categoryList']=$this->categoryList;
        
        return view('customerpanel::equipment.create', $data);
    }

    public function getChildren($category, $depth)
    { 
        $indent = str_repeat('--', $depth);
        $this->categoryList[$category->id] = $indent.''.$category->name;

        // Get direct children of this category
        $children = Category::where('parent_id', $category->id)->get();

        foreach ($children as $child) {
            $this->getChildren($child, $depth+1); // Recursive call
        }
    }

    public function getEquipmentModel(Request $request)
    {
        $manufacturerId = $request->manufacturerId;
        try {
            $result = EquipmentModel::where('manufacturer_id',$manufacturerId)->pluck('name','id');
            return response()->json(['status'=> true, 'data'=> $result]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=> false]);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'vin' => 'nullable|string|max:50',
            'manufacturer_id' => 'required|numeric',
            'equipment_model_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'year' => 'required|string|max:4',
            'hours' => 'nullable|numeric',
            'condition' => 'required|string',
            'price' => 'required|numeric',
            'currency_id' => 'required|numeric',
            'machine_location' => 'required|string|max:250',
            'stock_no' => 'nullable|string|max:30',
            'description' => 'required|string',
            'details' => 'required|string',
            'company_name' => 'required|string|max:200',
            'contact_name' => 'required|string|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_no' => ['required', new PhoneNumber()],
            'meta_title' => 'required|string|max:250',
            'meta_keyword' => 'nullable|string',
            'meta_desc' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            'images' => 'required', // optional: ensure at least one file is uploaded
            'images.*' => 'required|mimes:jpeg,jpg,png,webp|max:1024', // 1MB per file
        ]);

        $input = $request->all();

        $manufacturer = Manufacturer::find($request->manufacturer_id);
        $eqipumentmodel = EquipmentModel::find($request->equipment_model_id);
        $categoryQuery = Category::find($request->category_id);
        $input['name'] = $request->year.' '.strtoupper($manufacturer->name).' '.strtoupper($eqipumentmodel->name);
        $slugBase = $input['name'] . '-' . $categoryQuery->name; // combine strings
        $input['slug'] = date('ymdhis') . rand(111, 999) . '-' . Str::slug($slugBase);

        $input['customer_id'] = $this->activeCustomerId;

        if ($request->has('thumbnail')) {
            
            $image = $request->file('thumbnail');
            // $imageName = 'thumbnail_' . Str::random(10).time(). '.' .$image->getClientOriginalExtension();
            $imageName = 'thumbnail_' . Str::random(10).time(). '.webp';


            $uploadPath = public_path('uploads/equipmentImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);
            $input['thumbnail'] = $imageName;
        } 

        
        $uploadedFiles = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
            // $filename = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();
            $filename = 'image_' . Str::random(10) . time() . '.webp';

                // Ensure folder exists
                $destinationPath = public_path('uploads/equipmentImage');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);

                $uploadedFiles[] = [
                    'file' => $filename,
                    'type' => 'image',
                ];
            }
        }

        $result = Equipment::create($input);
        if ($result) {

            //Images Upload Section
            foreach ($uploadedFiles as $doc) {
                EquipmentImage::create([
                    'equipment_id' => $result->id,
                    'file' => $doc['file'],
                    'type' => $doc['type'],
                ]);
            }
            //Images Upload Section

            return redirect()->route('customer.equipment.index')->with('success', 'Equipment added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('customerpanel::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->activemenu = "equipment";
        $data['activemenu'] = $this->activemenu;

        $equipmentQuery = Equipment::where('customer_id',$this->activeCustomerId)->findOrFail($id);
        $data['equipment'] = $equipmentQuery;
        $data['currencyList'] = Currency::active()->get();
        $data['manufacturerList'] = Manufacturer::active()->get();
        $data['modelList']= EquipmentModel::where('manufacturer_id',$equipmentQuery->manufacturer_id)->get();

        $categoryQuery=Category::where('parent_id',0)->get();
        if(!empty($categoryQuery))
        {
            foreach ($categoryQuery as $category) {
                $this->getChildren($category,0);
            }
        }
        $data['categoryList']=$this->categoryList;

        return view('customerpanel::equipment.edit', $data);
    }

    public function delete_equipment_image(Request $request)
    {
        $id = $request->input('id');
        $data = EquipmentImage::find($id);
        $equipmentExist = Equipment::where('customer_id',$this->activeCustomerId)->where('id',$data->equipment_id)->exists();
        if ($equipmentExist && $data) {
            // Check if the file exists and delete it
            $imagePath = public_path('uploads/equipmentImage/' . $data->file);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $data->delete();
            return response()->json(['success' => true, 'message' => 'Document deleted successfully.']);
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Something went wrong!.']);
        }

        
    }

    public function update(Request $request, $id) {
        $request->validate([
            'vin' => 'nullable|string|max:50',
            'manufacturer_id' => 'required|numeric',
            'equipment_model_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'year' => 'required|string|max:4',
            'hours' => 'nullable|numeric',
            'condition' => 'required|string',
            'price' => 'required|numeric',
            'currency_id' => 'required|numeric',
            'machine_location' => 'required|string|max:250',
            'stock_no' => 'nullable|string|max:30',
            'description' => 'required|string',
            'details' => 'required|string',
            'company_name' => 'required|string|max:200',
            'contact_name' => 'required|string|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_no' => ['required', new PhoneNumber()],
            'meta_title' => 'required|string|max:250',
            'meta_keyword' => 'nullable|string',
            'meta_desc' => 'nullable|string',
        ]);

        $equipment = Equipment::where('customer_id',$this->activeCustomerId)->findOrFail($id);
        $input = $request->all();
        $input['publish_status'] = $request->publish_status ? 1 : 0;

        $manufacturer = Manufacturer::find($request->manufacturer_id);
        $eqipumentmodel = EquipmentModel::find($request->equipment_model_id);
        $categoryQuery = Category::find($request->category_id);

        if (
            $request->year != $equipment->year ||
            $request->manufacturer_id != $equipment->manufacturer_id ||
            $request->equipment_model_id != $equipment->equipment_model_id ||
            $request->category_id != $equipment->category_id
        ) {

            $input['name'] = $request->year . ' ' . strtoupper($manufacturer->name) . ' ' . strtoupper($eqipumentmodel->name);
            $slugBase = $input['name'] . '-' . $categoryQuery->name;
            $input['slug'] = date('ymdhis') . rand(111, 999) . '-' . Str::slug($slugBase);
        }

        if ($request->has('thumbnail')) {
            $request->validate([
                'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);
            $image = $request->file('thumbnail');
            // $imageName = 'thumbnail_' . Str::random(10).time(). '.' .$image->getClientOriginalExtension();
            $imageName = 'thumbnail_' . Str::random(10).time(). '.webp';


            $uploadPath = public_path('uploads/equipmentImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);
            $input['thumbnail'] = $imageName;

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/equipmentImage/' . $equipment->thumbnail);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }
        } 

        
        $uploadedFiles = [];

        if ($request->hasFile('images')) {
            $request->validate([
                'images' => 'required', // optional: ensure at least one file is uploaded
                'images.*' => 'required|mimes:jpeg,jpg,png,webp|max:1024', // 1MB per file
            ]);
            foreach ($request->file('images') as $file) {
            // $filename = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();
            $filename = 'image_' . Str::random(10) . time() . '.webp';

                // Ensure folder exists
                $destinationPath = public_path('uploads/equipmentImage');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);

                $uploadedFiles[] = [
                    'file' => $filename,
                    'type' => 'image',
                ];
            }
        }

        $result = $equipment->update($input);
        if ($result) {

            if(!empty($uploadedFiles))
            {
                //Images Upload Section
                foreach ($uploadedFiles as $doc) {
                    EquipmentImage::create([
                        'equipment_id' => $equipment->id,
                        'file' => $doc['file'],
                        'type' => $doc['type'],
                    ]);
                }
                //Images Upload Section
            }
            

            return redirect()->route('customer.equipment.index')->with('success', 'Equipment updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {

        $data = Equipment::where('customer_id',$this->activeCustomerId)->findOrFail($id);
        $result = $data->delete();
        if ($result) {
            return redirect()->route('customer.equipment.index')->with('success', 'Equipment deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
