<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private $productService;
    public $data = [];

    public function __construct(ProductService $productService)
    {
        $this->productService          = $productService;
    }


    public function index(Request $request)
    {
        $this->data['products'] = $this->productService->list();
        return view('products.index',$this->data);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        try {
            $this->productService->store($request);
            return redirect()->route('product.index')->withSuccess('Product create a successfully');
        } catch (\Exception $exception) {
            return redirect()->route('product.index')->withError($exception->getMessage());
        }
    }

    public function edit(Product $product)
    {
        $this->data['product'] = $product;
        return view('products.edit',$this->data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $this->productService->update($request, $product);
            return redirect()->route('product.index')->withSuccess('Product update successfully');
        } catch (\Exception $exception) {
            return redirect()->route('product.index')->withError($exception->getMessage());
        }
    }

    public function show(Product $product)
    {
        $this->data['product'] = $this->productService->show($product);
        return view('products.show', $this->data);
    }

    public function destroy(Product $product)
    {
        try {
            $this->productService->destroy($product);
            return redirect()->route('product.index')->withSuccess('Product delete successfully');
        } catch (\Exception $exception) {
            return redirect()->route('product.index')->withError($exception->getMessage());
        }
    }

}
