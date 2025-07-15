<?php

namespace Modules\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Subscription\Database\Factories\SubscriptionFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $table="subscriptions";
    protected $fillable = [
        'customer_id',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'type',
        'amount',
        'txn_id',
        'payment_type',
        'status'
    ];

    // protected static function newFactory(): SubscriptionFactory
    // {
    //     // return SubscriptionFactory::new();
    // }
}
