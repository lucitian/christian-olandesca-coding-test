<?php

namespace App\Services\Product;

use App\Exceptions\NotFoundException;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\BaseService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ProductService extends BaseService
{
    public function __construct(
        private ProductRepository $productRepository
    )
    {
    }

    /**
     * @param array $request
     * @return array
     */
    public function list(array $request = [])
    {
        return $this->productRepository->list($request);
    }

    /**
     * @param $productId
     * @return mixed
     * @throws NotFoundException
     */
    public function find($productId)
    {
        try {
            return $this->productRepository->find($productId);
        } catch (\Throwable) {
            throw new NotFoundException();
        }
    }

    /**
     * @param array $productData
     * @return mixed
     * @throws NotFoundException
     */
    public function saveProduct(array $productData)
    {
        try {
            return Product::create($productData);
        } catch (\Throwable $exception) {
            Log::error('Cannot create product', ['exception' => $exception]);
            throw new NotFoundException();
        }
    }


    /**
     * @param $productId
     * @param array $productData
     * @return mixed
     * @throws NotFoundException
     */
    public function updateProduct($productId, array $productData)
    {
        try {
            $product = Product::findOrFail($productId);
        } catch (\Throwable $exception) {
            Log::error('Cannot find product for update', ['exception' => $exception]);
            throw new NotFoundException();
        }

        $product->update(Arr::except($productData, ['id']));


        return $product;
    }

    /**
     * @param $productId
     * @return mixed
     * @throws NotFoundException
     */
    public function destroyProduct($productId)
    {
        try {
            $product = Product::findOrFail($productId);
        } catch (\Throwable $exception) {
            Log::error('Cannot find product for delete', ['exception' => $exception]);
            throw new NotFoundException();
        }

        return $product->delete();
    }

}
