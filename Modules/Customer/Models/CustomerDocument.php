<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Customer\Database\Factories\CustomerDocumentFactory;

class CustomerDocument extends Model
{
    use HasFactory;

    protected $table="customer_documents";
    protected $fillable = [
        'customer_id',
        'file',
        'type'
    ];

    // protected static function newFactory(): CustomerDocumentFactory
    // {
    //     // return CustomerDocumentFactory::new();
    // }
}
