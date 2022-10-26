<?php

namespace App\Repositories;

class ProductRepository extends BaseRepository
{
    protected string $table = 'products';

    protected string $primaryKeyField = 'id';

    protected array $fillables = [
        'name',
        'description',
        'price'
    ];


    /**
     * @param array $request
     * @return array
     */
    public function list(array $request = []): array
    {
        $limit  = $request['limit'] ?? 10;
        $offset = $request['offset'] ?? 0;

        $offset = $offset * $limit;


        $query = "SELECT
                    id,
                    name,
                    description,
                    price,
                    created_at,
                    updated_at
                FROM products
                LIMIT $limit OFFSET $offset";

        return $this->connection->select($query);
    }
}
