<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Banner\Database\Factories\BannerFactory;

class Banner extends Model
{
    use HasFactory;

    protected $table="banners";
    protected $fillable = [
        'title',
        'subtitle',
        'desc',
        'image',
        'status'
    ];

    protected function scopeActive($query)
    {
        return $query->where('status',1);
    }

    // protected static function newFactory(): BannerFactory
    // {
    //     // return BannerFactory::new();
    // }
}
