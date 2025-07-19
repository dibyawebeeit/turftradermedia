<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Cms\Database\Factories\HomeFactory;

class Home extends Model
{
    use HasFactory;

     protected $table="cms_home";
    protected $fillable = [
        'title1',
        'title2',
        'banner',
        'section1_title',
        'section1_title2',
        'section1_button_text',
        'section1_button_url',
        'section1_image',
        'section2_title',
        'section2_title2',
        'section2_title3',
        'section2_image',
        'meta_title',
        'meta_keyword',
        'meta_desc'
    ];

    // protected static function newFactory(): HomeFactory
    // {
    //     // return HomeFactory::new();
    // }
}
