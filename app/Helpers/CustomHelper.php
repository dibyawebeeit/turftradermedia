<?php

use Modules\Category\Models\Category;
use Modules\Setting\Models\Setting;
use Carbon\Carbon;

if (! function_exists('format_price')) {
    function format_price($amount)
    {
        if($amount)
        {
            return '$' . number_format($amount, 2);
        }
        return 'NA';
        
    }
}

if (! function_exists('new_format_price')) {
    function new_format_price($amount)
    {
        if (!is_null($amount)) {
            return number_format(ceil((float)$amount), 0, '.', ','); // e.g. 1,001
        }
        return 'NA';
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

if (! function_exists('dateFormater')) {
    function dateFormater($date)
    {
        if($date)
        {
            $formattedDate = Carbon::parse($date)->format('Y-m-d h:i A');
            return $formattedDate; // Output: 2025-07-16 06:42 AM
        }
        return '-';
        
    }
}




if (! function_exists('categories')) {
    function categories()
    {
        $result = Category::active()->where('parent_id',0)->get();
        return $result;
    }
}


if (! function_exists('allcategories')) {
    function allcategories()
    {
        $categoryList = [];

        $categoryQuery = Category::where('parent_id', 0)->get();

        foreach ($categoryQuery as $category) {
            buildCategoryList($category, 0, $categoryList);
        }

        return $categoryList;
    }
}

if (! function_exists('parentCategoryIds')) {
    function parentCategoryIds()
    {
        return Category::whereIn('id', function ($query) {
            $query->select('parent_id')
                ->from('categories')
                ->whereNotNull('parent_id');
        })->pluck('id')->toArray();
    }
}

if (! function_exists('buildCategoryList')) {
    function buildCategoryList($category, $depth, &$categoryList)
    {
        $indent = str_repeat('--', $depth);
        $categoryList[$category->id] = $indent . $category->name;

        $children = Category::where('parent_id', $category->id)->get();

        foreach ($children as $child) {
            buildCategoryList($child, $depth + 1, $categoryList);
        }
    }
}




