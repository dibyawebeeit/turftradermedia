<?php

namespace Modules\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Permission\Database\Factories\RolehaspermissionFactory;

class Rolehaspermission extends Model
{
    use HasFactory;

    protected $table="role_has_permissions";
    protected $fillable = [
        'permission_id',
        'role_id'
    ];

    // protected static function newFactory(): RolehaspermissionFactory
    // {
    //     // return RolehaspermissionFactory::new();
    // }
}
