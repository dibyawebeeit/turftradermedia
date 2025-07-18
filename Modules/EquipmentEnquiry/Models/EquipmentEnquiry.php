<?php

namespace Modules\EquipmentEnquiry\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\EquipmentEnquiry\Database\Factories\EquipmentEnquiryFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Equipment\Models\Equipment;

class EquipmentEnquiry extends Model
{
    use HasFactory;

    protected $tanle="equipment_enquiries";
    protected $fillable = [
        'equipment_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'postal_code',
        'message',
        'marketing_opt_in'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class,'equipment_id','id');
    }

    // Accessor + Mutator for first_name
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value), // accessor
            set: fn ($value) => ucfirst($value), // mutator
        );
    }

    // Accessor + Mutator for last_name
    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value), // accessor
            set: fn ($value) => ucfirst($value), // mutator
        );
    }

    // protected static function newFactory(): EquipmentEnquiryFactory
    // {
    //     // return EquipmentEnquiryFactory::new();
    // }
}
