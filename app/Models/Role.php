<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
//     public $guarded = [];
    protected $fillable = ['name'];

    public function scopeWhereRoleNot($query, $role_name)
    {
        return $query->whereNotIn('name', (array)$role_name);
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }
}
