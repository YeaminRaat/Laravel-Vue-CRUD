<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function brand(){
    	return $this->belongsTo(Brand::class);
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }
}
