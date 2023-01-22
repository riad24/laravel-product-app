<?php

namespace App\Observers;

use App\Helpers\ParallaxLogicLog;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */

    public function creating(Product $product)
    {
        $product->slug = generateSlug($product->name);
        ParallaxLogicLog::product()->info('Product create a successfully', ['user' => auth()->user()->id, 'product' => $product]);

    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $product->slug = generateSlug($product->name);
        ParallaxLogicLog::product()->info('Product Update a successfully', ['user' => auth()->user()->id, 'product' => $product]);
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        ParallaxLogicLog::product()->info('Product Delete a successfully', ['user' => auth()->user()->id, 'product' => $product]);
    }

}
