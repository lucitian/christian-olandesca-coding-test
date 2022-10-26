<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;

abstract class BaseRepository
{
    protected string $table = '';

    protected string $primaryKeyField = '';

    protected array $fillables = [];

    protected Connection $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(
        Connection $connection
    )
    {
        $this->connection = $connection;
    }

    /**
     * @param $id
     * @return Model|Builder|object
     * @throws NotFoundException
     */
    public function find($id)
    {
        $data = $this->connection
            ->table($this->table)
            ->where($this->primaryKeyField, $id)
            ->first();

        if ($data == null) {
            throw new NotFoundException();
        }

        return $data;
    }

    /**
     * @param array $data
     * @return Model|Builder|object
     * @throws NotFoundException
     */
    public function create(array $data)
    {
        $data = Arr::only($data, $this->fillables);
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $id = $this->connection
            ->table($this->table)
            ->insertGetId($data);

        return $this->find($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return Model|Builder|object
     * @throws NotFoundException
     */
    public function update ($id, array $data)
    {
        if ($this->find($id) == null) {
            throw new NotFoundException();
        }

        $data = Arr::only($data, $this->fillables);
        $data['updated_at'] = now();

        $this->connection
            ->table($this->table)
            ->where($this->primaryKeyField, $id)
            ->update($data);

        return $this->find($id);
    }

    /**
     * @param $id
     * @return int
     * @throws NotFoundException
     */
    public function delete($id)
    {
        if ($this->find($id) == null) {
            throw new NotFoundException();
        }

        return $this->connection
            ->table($this->table)
            ->where($this->primaryKeyField, $id)
            ->delete();
    }

}
