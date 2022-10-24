<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    //
    public function index() {
        return response()->json(['products' => Product::all()], 200);
    }

    //Show product
    public function show(Product $product) {
        return response()->json(['product' => $product], 200);
    }

    public function create() {

    }

    //Store product
    public function store() {
        $product = $this->validateProduct(new Product());

        Product::create($product);

        return response()->json(['product' => $product], 200);
    }

    public function update(Product $product) {
        $attributes = $this->validateProduct($product);
        $product->update($attributes);

        return response()->json(['product' => $product], 200);
    }

    public function validateProduct(?Product $product = null) : array {
        return request()->validate([
            'name' =>  ['required', Rule::unique('products', 'name')->ignore($product->id)],
            'description' => 'required',
            'price' => 'required'
        ]);
    }
}
