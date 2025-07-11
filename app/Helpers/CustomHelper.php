<?php

use Modules\Category\Models\Category;
use Modules\Setting\Models\Setting;


if (! function_exists('format_price')) {
    function format_price($amount)
    {
        return '$' . number_format($amount, 2);
    }
}

if (! function_exists('sitesetting')) {
    function sitesetting()
    {
        $result = Setting::first();
        return $result;
    }
}

if (! function_exists('noImage')) {
    function noImage()
    {
        $image = asset('uploads/noimage.jpg');
        return $image;
    }
}


if (! function_exists('categories')) {
    function categories()
    {
        $result = Category::active()->where('parent_id',0)->get();
        return $result;
    }
}

