<?php

namespace Modules\Faq\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Faq\Database\Factories\FaqFactory;

class Faq extends Model
{
    use HasFactory;

    protected $table="faqs";
    protected $fillable = [
        'question',
        'answer',
        'status'
    ];

    // protected static function newFactory(): FaqFactory
    // {
    //     // return FaqFactory::new();
    // }
}
