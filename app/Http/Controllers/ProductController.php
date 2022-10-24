<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}
