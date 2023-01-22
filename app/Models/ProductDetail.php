<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{

    protected $fillable = [
        'product_id','description','features', 'image_url',
    ];
}
