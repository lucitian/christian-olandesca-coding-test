<?php

namespace App\Services\Products;

use App\Exceptions\NotFoundException;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ProductService
{
    //List products
    /**
     * @param mixed $limit
     * @return LengthAwarePaginator
     */
    public function list(mixed $limit) {
        return Product::query()->paginate($limit ?? 0);
    }

    //Find specific product

    /**
     * @param $productId
     * @return mixed
     * @throws NotFoundException
     */
    public function find($productId) {
        try {
            $product = Product::findOrFail($productId);
        } catch (\Throwable $exception){
            Log::error($exception);
            throw new NotFoundException();
        }

        return $product;
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create(array $request) {
        return Product::create($request);
    }

    /**
     * @param $productId
     * @param array $request
     * @return mixed
     * @throws NotFoundException
     */
    public function update($productId, array $request) {
        try {
            $product = Product::findOrFail($productId);
        } catch (\Throwable $exception) {
            Log::error($exception);
            throw new NotFoundException();
        }
        $product->update($request);

        return $product;
    }

    /**
     * @param $productId
     * @return string
     * @throws NotFoundException
     */
    public function destroy($productId) {
        try {
            $product = Product::findOrFail($productId);
        } catch (\Throwable $exception) {
            Log::error($exception);
            throw new NotFoundException();
        }
        $product->delete();

        return 'Product deleted successfully!';
    }
}
