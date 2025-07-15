<?php

namespace Modules\Manufacturer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Manufacturer\Database\Factories\ManufacturerFactory;

class Manufacturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="manufacturers";
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // protected static function newFactory(): ManufacturerFactory
    // {
    //     // return ManufacturerFactory::new();
    // }
}
