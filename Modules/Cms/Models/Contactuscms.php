<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Cms\Database\Factories\ContactuscmsFactory;

class Contactuscms extends Model
{
    use HasFactory;

    protected $table="cms_contactus";
    protected $fillable = [
        'title',
        'title2',
        'button_text',
        'button_url',
        'desc',
        'banner',
        'meta_title',
        'meta_keyword',
        'meta_desc'
    ];

    // protected static function newFactory(): ContactuscmsFactory
    // {
    //     // return ContactuscmsFactory::new();
    // }
}
