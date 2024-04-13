<?php

namespace Services;

use Repositories\OrderRepository;
use Repositories\OrderItemRepository;


class OrderService
{

    private $orderrepository;
    private $orderitemrepository;

    function __construct()
    {
        $this->repository = new OrderRepository();
        $this->orderitemrepository = new OrderItemRepository();
    }

    // All Order thingss
    public function getAll($offset = NULL, $limit = NULL)
    {
        return $this->orderrepository->getAll($offset, $limit);
    }

    public function getOne($id)
    {
        return $this->orderrepository->getOne($id);
    }

    public function insert($order)
    {
        return $this->orderrepository->insert($order);
    }

    // All OrderItem thingss
    public function getAllOrderItems($offset = NULL, $limit = NULL)
    {
        return $this->orderitemrepository->getAll($offset, $limit);
    }

    public function insertOrderItem($orderItem)
    {
        return $this->orderitemrepository->insert($orderItem);
    }
}