<?php

namespace Repositories;

class OrderRepository extends Repository
{

    public function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT * FROM orders";
            if ($offset != NULL && $limit != NULL) {
                $query .= " LIMIT :offset, :limit";
            }
            $stmt = $this->connection->prepare($query);
            if ($offset != NULL && $limit != NULL) {
                $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
                $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
            }
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Models\Order');
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOne($id)
    {
        try {
            $query = "SELECT * FROM orders WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, 'Models\Order');
            return $stmt->fetch();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function startOrder($order)
    {
        try {
            $query = "INSERT INTO orders (user_id, status, total_price) VALUES (:user_id, :status, :total_price)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':user_id', $order->user_id);
            $stmt->bindParam(':status', $order->status);
            $stmt->bindParam(':total_price', $order->total_price);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateStatus($id, $status)
    {
        try {
            $query = "UPDATE orders SET status = :status WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}