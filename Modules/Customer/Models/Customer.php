<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Customer\Models\CustomerDocument;

// use Modules\Customer\Database\Factories\CustomerFactory;

class Customer extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table="customers";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'password',
        'image',
        'role',
        'is_free',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

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

    public function documents()
    {
        return $this->hasMany(CustomerDocument::class);
    }



    // protected static function newFactory(): CustomerFactory
    // {
    //     // return CustomerFactory::new();
    // }
}
