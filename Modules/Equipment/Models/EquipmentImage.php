<?php

namespace Modules\Equipment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Equipment\Database\Factories\EquipmentImageFactory;

class EquipmentImage extends Model
{
    use HasFactory;

    protected $table="equipment_images";
    protected $fillable = [
        'equipment_id',
        'file',
        'type'
    ];

    // protected static function newFactory(): EquipmentImageFactory
    // {
    //     // return EquipmentImageFactory::new();
    // }
}
