<?php

namespace Controllers;

use Exception;
use Services\ProductService;

class ProductController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new ProductService();
    }

    public function getAll(): void
    {

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $products = $this->service->getAll($offset, $limit);

        $this->respond($products);
    }

    public function getByCategory($id): void
    {
        $products = $this->service->getByCategory($id);

        $this->respond($products);
    }

    public function getOne($id): void
    {
        $product = $this->service->getOne($id);

        if (!$product) {
            $this->respondWithError(404, "Product not found");
            return;
        }

        $this->respond($product);
    }

    public function create()
    {
        if(!$this->userIsAdmin()) {
            $this->respondWithError(401, "Unauthorized");
            return;
        }

        try {
            $product = $this->createObjectFromPostedJson("Models\\Product");
            $product = $this->service->insert($product);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($product);
    }

    public function update($id)
    {
        if (!$this->userIsAdmin()) {
            $this->respondWithError(401, "Unauthorized");
            return;
        }

        try {
            $product = $this->createObjectFromPostedJson("Models\\Product");
            $product = $this->service->update($product, $id);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($product);
    }

    public function delete($id)
    {
        if(!$this->userIsAdmin()) {
            $this->respondWithError(401, "Unauthorized");
            return;
        }
        try {
            $this->service->delete($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond(true);
    }
}
