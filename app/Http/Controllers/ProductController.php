<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\Products\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'products' => $this->productService->list($request->limit)
        ]);
    }

    //Show product

    /**
     * @param $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function show($id) {
        return response()->json([
            'product' => $this->productService->find($id)
        ]);
    }

    //Store product
    /**
     * @param ProductRequest $productRequest
     * @return JsonResponse
     */
    public function store(ProductRequest $productRequest) {
        return response()->json([
            'product' => $this->productService->create($productRequest->all())
        ]);
    }

    //Update product

    /**
     * @param $id
     * @param ProductRequest $productRequest
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function update($id, ProductRequest $productRequest) {
        return response()->json([
            'product' => $this->productService->update($id, $productRequest->except('id'))
        ]);
    }

    //Delete product
    /**
     * @param $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function destroy($id) {
        return response()->json([
            'message' => $this->productService->destroy($id)
        ]);
    }

}
