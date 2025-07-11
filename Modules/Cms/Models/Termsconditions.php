<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Cms\Database\Factories\TermsconditionsFactory;

class Termsconditions extends Model
{
    use HasFactory;

    protected $table="cms_terms_conditions";
    protected $fillable = [
        'title',
        'title2',
        'desc',
        'meta_title',
        'meta_keyword',
        'meta_desc'
    ];

    // protected static function newFactory(): TermsconditionsFactory
    // {
    //     // return TermsconditionsFactory::new();
    // }
}
