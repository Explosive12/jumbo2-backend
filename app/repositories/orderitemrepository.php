<?php

namespace Repositories;

class OrderitemRepository extends Repository
{

    public function insert($orderitem)
    {
        try {
            $query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':order_id', $orderitem->order_id);
            $stmt->bindParam(':product_id', $orderitem->product_id);
            $stmt->bindParam(':quantity', $orderitem->quantity);
            $stmt->bindParam(':price', $orderitem->price);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT * FROM order_items";
            if ($offset != NULL && $limit != NULL) {
                $query .= " LIMIT :offset, :limit";
            }
            $stmt = $this->connection->prepare($query);
            if ($offset != NULL && $limit != NULL) {
                $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
                $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            }
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Models\Orderitem');
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getByOrderId($id)
    {
        try {
            $query = "SELECT * FROM order_items WHERE order_id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Models\Orderitem');
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}

