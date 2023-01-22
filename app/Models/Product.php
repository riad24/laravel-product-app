<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','quantity', 'price', 'slug',
    ];


    public function productDetail() : \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function getImageAttribute()
    {

        if (!blank($this->productDetail) && isset($this->productDetail->image_url)) {
            return asset('image/'.$this->productDetail->image_url);
        }
        return asset('image/no-image-available.png');
    }

    public function getMyFeatureAttribute()
    {
        if(!blank($this->productDetail)){
            return trans('feature.'.$this->productDetail->features);
        }
    }
}
