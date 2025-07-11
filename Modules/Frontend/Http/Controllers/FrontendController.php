<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Banner\Models\Banner;
use Modules\Category\Models\Category;
use Modules\Cms\Models\Aboutus;
use Modules\Cms\Models\Advertising;
use Modules\Cms\Models\Contactuscms;

class FrontendController extends Controller
{
    public function index()
    {
        $data['banner'] = Banner::active()->get();
        $data['categoryList'] = Category::active()->where('parent_id',0)->get();
        return view('frontend::index', $data);
    }
    public function signin()
    {
        return view('frontend::signin');
    }
    public function register()
    {
        return view('frontend::register');
    }
    public function advertising(Request $request)
    {
        $data['advertising'] = Advertising::first();
        return view('frontend::advertising', $data);
    }
    public function about_us()
    {
        $data['aboutus']=Aboutus::first();
        return view('frontend::about_us', $data);
    }
    public function contact_us()
    {
        $data['contactus'] = Contactuscms::first();
        return view('frontend::contact_us', $data);
    }
    public function products()
    {
        $category =null;
        $catQuery = Category::with('childs')->where('parent_id',0)->get();
        if(count($catQuery) > 0)
        {
            foreach($catQuery as $key => $value)
            {
                $subcategory =null;
                if(count($value->childs) > 0)
                {
                    foreach($value->childs as $child)
                    {
                        $subcategory[] = array(
                            'id' => $child->id,
                            'name'=> $child->name
                        );
                    }
                }
                $category[] = array(
                    'id' => $value->id,
                    'name'=> $value->name,
                    'subcategory' => $subcategory
                );
                
            }
        }
        $data['allCategory'] = $category;


        // dd($data['allCategory']);
        return view('frontend::products', $data);
    }
    public function product_details()
    {
        return view('frontend::product_details');
    }
}
