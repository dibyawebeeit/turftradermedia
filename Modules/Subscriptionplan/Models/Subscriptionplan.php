<?php

namespace Modules\Subscriptionplan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Subscriptionplan\Database\Factories\SubscriptionplanFactory;

class Subscriptionplan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="subscription_plans";
    protected $fillable = [
        'name',
        'monthly_price',
        'annual_price',
        'description',
        'offer',
        'duration',
        'no_of_listing',
        'type',
        'status'
    ];

    protected function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // protected static function newFactory(): SubscriptionplanFactory
    // {
    //     // return SubscriptionplanFactory::new();
    // }
}
