<?php

namespace App\Services\Products;

use App\Exceptions\NotFoundException;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(private ProductRepository $productRepository)
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

    //Find specific product
    /**
     * @param $productId
     * @return mixed
     * @throws NotFoundException
     */
    public function find($productId)
    {
        return $this->productRepository->find($productId);
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create(array $request)
    {
        return $this->productRepository->create($request);
    }

    /**
     * @param $productId
     * @param array $request
     * @return mixed
     * @throws NotFoundException
     */
    public function update($productId, array $request)
    {
        return $this->productRepository->update($productId, $request);
    }


    /**
     * @param $productId
     * @return string
     * @throws NotFoundException
     */
    public function destroy($productId)
    {
        $this->productRepository->delete($productId);

        return 'Product deleted successfully!';
    }
}
