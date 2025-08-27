<?php

namespace Modules\Ads\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Ads\Database\Factories\AdsFactory;

class Ads extends Model
{
    use HasFactory;

    protected $table="ads";
    protected $fillable = [
        'type',
        'image',
        'external_link',
        'status'
    ];

    // protected static function newFactory(): AdsFactory
    // {
    //     // return AdsFactory::new();
    // }
}
