<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'video', 'amount', 'view', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function allergens()
    {
        return $this->hasMany('App\Allergen');
    }

}
