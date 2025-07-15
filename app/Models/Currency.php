<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = "currencies";
    protected $fillable = [
        'name',
        'sign',
        'country',
        'status'
    ];

    public function scopeActive()
    {
        return $this->where('status', 1)->select('id','name','sign');
    }
}
