<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\ProductRequest;
use App\Services\Products\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param ProductService $productService
     */
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
            'products' => $this->productService->list($request->all())
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function show($id)
    {
        return response()->json([
            'product' => $this->productService->find($id)
        ]);
    }

    /**
     * @param ProductRequest $productRequest
     * @return JsonResponse
     */
    public function store(ProductRequest $productRequest)
    {
        return response()->json([
            'product' => $this->productService->create($productRequest->all())
        ]);
    }

    /**
     * @param $id
     * @param ProductRequest $productRequest
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function update($id, ProductRequest $productRequest)
    {
        return response()->json([
            'product' => $this->productService->update($id, $productRequest->except('id'))
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function destroy($id)
    {
        return response()->json([
            'message' => $this->productService->destroy($id)
        ]);
    }

}
