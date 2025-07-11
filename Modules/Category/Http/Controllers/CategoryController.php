<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;

class CategoryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:category_list|category_add|category_edit|category_delete', ['only' => ['index','store']]);
         $this->middleware('permission:category_add', ['only' => ['create','store']]);
         $this->middleware('permission:category_edit', ['only' => ['edit','update']]);
         $this->middleware('permission:category_delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data['dataList'] = Category::orderBy('id', 'desc')->get();
        return view('category::index', $data);
    }

    public $categoryList = array();

    public function create()
    {
        $categoryQuery=Category::where('parent_id',0)->get();
        if(!empty($categoryQuery))
        {
            foreach ($categoryQuery as $category) {
                $this->getChildren($category,0);
            }
        }
        $data['categoryList']=$this->categoryList;
        // dd($data['categoryList']);
        return view('category::create',$data);
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

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $isExist = Category::where('name',$request->name)->where('parent_id',$request->parent_id)->exists();
        if($isExist)
        {
            return redirect()->back()->with('error', 'Category already exist!');
        }
        $input = $request->all();

        if ($request->has('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);
            $image = $request->file('image');
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = public_path('uploads/categoryImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);
            $input['image'] = $imageName;
        } 

        $input['slug']= Str::slug($request->name,'-');
        $input['status'] = $request->status ? 1 : 0;
        $result = Category::create($input);
        if ($result) {
            return redirect()->route('category.index')->with('success', 'Category added successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['dataList'] = Category::findOrFail($id);
        $categoryQuery=Category::where('parent_id',0)->get();
        if(!empty($categoryQuery))
        {
            foreach ($categoryQuery as $category) {
                $this->getChildren($category,0);
            }
        }
        $data['categoryList']=$this->categoryList;
        return view('category::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'parent_id' => 'required',
        ]);

        $data = Category::find($id);
        $input = $request->all();

         if ($request->has('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
            ]);

            // Get the uploaded image
            $image = $request->file('image');

            // Create a custom file name
            $imageName = 'image_' . Str::random(10) . time() . '.' . $image->getClientOriginalExtension();

            // Define the directory path for where you want to store the image
            $uploadPath = public_path('uploads/categoryImage');  // This is outside of the storage folder

            // Check if the directory exists, if not create it
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0775, true);
            }

            // Move the image to the custom location
            $image->move($uploadPath, $imageName);

            // Check if the file exists and delete it
            $imagePath = public_path('uploads/categoryImage/' . $data->image);
            if (File::exists($imagePath)) {
                // Delete the file
                File::delete($imagePath);
            }

            $input['image'] = $imageName;
        } 

        $input['slug']= Str::slug($request->name,'-');
        $input['status'] = $request->status ? 1 : 0;
        $result = $data->update($input);
        if ($result) {
            return redirect()->route('category.index')->with('success', 'Category updated successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $data = Category::findOrfail($id);

        // Check if the file exists and delete it
        $imagePath = public_path('uploads/categoryImage/' . $data->image);
        if (File::exists($imagePath)) {
            // Delete the file
            File::delete($imagePath);
        }

        $result = $data->delete();
        if ($result) {
            return redirect()->back()->with('success', 'Category deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
