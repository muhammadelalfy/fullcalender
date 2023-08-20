<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','email','phone','facebook','twitter','linkedin','instagram','address_ar','address_en'];

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->name_ar;
        }
        return $this->name_en;
    }
    public function getAddressAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->address_ar;
        }
        return $this->address_en;
    }

}
