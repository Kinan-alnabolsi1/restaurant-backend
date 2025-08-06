<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name_en', 'name_ar', 'image'];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
}
