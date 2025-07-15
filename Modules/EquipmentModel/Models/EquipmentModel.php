<?php

namespace Modules\EquipmentModel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Manufacturer\Models\Manufacturer;

// use Modules\EquipmentModel\Database\Factories\EquipmentModelFactory;

class EquipmentModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="equipment_models";
    protected $fillable = [
        'manufacturer_id',
        'name',
        'slug',
        'status'
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    // protected static function newFactory(): EquipmentModelFactory
    // {
    //     // return EquipmentModelFactory::new();
    // }
}
