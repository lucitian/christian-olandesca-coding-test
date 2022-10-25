<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) {
        $products = Product::query()->paginate($request->limit ?? 10);

        return response()->json(['products' => $products]);
    }

    //Show product
    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id) {
        try {
            $product = Product::findOrFail($id);
        } catch (\Throwable) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        return response()->json(['product' => $product]);
    }

    //Store product
    /**
     * @param ProductRequest $productRequest
     * @return JsonResponse
     */
    public function store(ProductRequest $productRequest) {
        $product = Product::create($productRequest->all());

        return response()->json(['product' => $product]);
    }

    //Update product
    /**
     * @param $id
     * @param ProductRequest $productRequest
     * @return JsonResponse
     */
    public function update($id, ProductRequest $productRequest) {
        try {
            $product = Product::findOrFail($id);
        } catch (\Throwable) {
            return response()->json(['message' => 'Product not found!'], 404);
        }
        $product->update($productRequest->except('id'));

        return response()->json(['product' => $product]);
    }

    //Delete product
    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id) {
        try {
            $product = Product::findOrFail($id);
        } catch (\Throwable) {
            return response()->json(['message' => 'Product not found!'], 404);
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!']);
    }

}
