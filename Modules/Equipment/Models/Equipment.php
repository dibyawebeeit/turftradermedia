<?php

namespace Modules\Equipment\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\EquipmentModel\Models\EquipmentModel;

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
        'stock_no',
        'machine_location',
        'description',
        'details',
        'thumbnail',
        'company_name',
        'contact_name',
        'contact_email',
        'contact_no',
        'meta_title',
        'meta_keyword',
        'meta_desc',
        'customer_id',
        'publish_status',
    ];

    public function images()
    {
        return $this->hasMany(EquipmentImage::class);
    }

    public function equipment_models()
    {
        return $this->hasMany(EquipmentModel::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }



    // protected static function newFactory(): EquipmentFactory
    // {
    //     // return EquipmentFactory::new();
    // }
}
