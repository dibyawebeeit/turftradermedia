<?php

namespace Modules\Equipment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Equipment\Database\Factories\EquipmentFactory;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="equipments";
    protected $fillable = [
        'category_id',
        'manufacturer_id',
        'equipment_model_id',
        'name',
        'slug',
        'vin',
        'year',
        'hours',
        'condition',
        'price',
        'currency_id',
        'machine_location',
        'description',
        'details',
        'thumbnail',
        'customer_id',
        'publish_status',
        'admin_approval'
    ];

    public function images()
    {
        return $this->hasMany(EquipmentImage::class);
    }

    // protected static function newFactory(): EquipmentFactory
    // {
    //     // return EquipmentFactory::new();
    // }
}
