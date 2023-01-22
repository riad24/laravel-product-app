<?php

namespace App\Services;


use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductDetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public $product;

    /**
     * @throws Exception
     */
    public function list()
    {
        try {
            return Product::with('productDetail')->paginate(10);
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $this->product = Product::create([
                    'name'      => $request->name,
                    'price'     => $request->price,
                    'quantity'  => $request->quantity,
                ]);

                $productDetail =  ProductDetail::create([
                    'product_id'    => $this->product->id,
                    'description'   => $request->description,
                    'features'      => $request->features,
                ]);

                if(request()->file('image')){
                    $this->imageUpload($request,$productDetail);
                }

            });
            return $this->product;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            DB::rollBack();
        }
    }

    /**
     * @throws Exception
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {
                $product->update([
                    'name'      => $request->name,
                    'price'     => $request->price,
                    'quantity'  => $request->quantity,
                ]);

                $product->productDetail->update([
                    'product_id'    => $product->id,
                    'description'   => $request->description,
                    'features'      => $request->features,
                ]);

                if(request()->file('image')){
                    $this->imageUpload($request,$product->productDetail);
                }
          });

            return $product;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            DB::rollBack();
        }
    }

    /**
     * @throws Exception
     */
    public function destroy(Product $product)
    {

        try {
            $product->productDetail->delete();
            return $product->delete();
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function show(Product $product)
    {
        try {
            return Product::with('productDetail')->findOrFail($product->id);
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    private function  imageUpload($request, $product)
    {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('image'), $imageName);
        $product->image_url = $imageName;
        $product->save();
    }


}
