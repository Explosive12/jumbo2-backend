<?php
namespace Services;

use Repositories\ProductRepository;

class ProductService
{

    private $repository;

    function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function getAll($offset = NULL, $limit = NULL)
    {
        return $this->repository->getAll($offset, $limit);
    }

    public function getByCategory($id)
    {
        return $this->repository->getByCategory($id);
    }

    public function getOne($id)
    {
        return $this->repository->getOne($id);
    }

    public function insert($product)
    {
        return $this->repository->insert($product);
    }

    public function update($product, $id)
    {
        return $this->repository->update($product, $id);
    }

    public function delete($item)
    {
        return $this->repository->delete($item);
    }
}

?>