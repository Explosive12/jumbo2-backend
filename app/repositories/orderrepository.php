<?php

namespace Repositories;

class OrderRepository extends Repository
{

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM orders";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}