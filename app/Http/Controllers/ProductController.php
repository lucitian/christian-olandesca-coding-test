<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $product = request()->validate([
            'name' =>  'required|max:255',
            'description' => 'required',
            'price' => 'required'
        ]);

        $product['slug'] = Str::slug($product['name'],'-');

        Product::create($product);

        return response()->json(['product' => $product], 200);
    }
}
