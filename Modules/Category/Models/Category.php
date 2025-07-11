<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Category\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="categories";
    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
        'status'
    ];

    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent_id')->select('id','name');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->select('id', 'name', 'parent_id');
    }

    protected function scopeActive($query)
    {
        return $query->where('status',1);
    }

    // protected static function newFactory(): CategoryFactory
    // {
    //     // return CategoryFactory::new();
    // }
}
