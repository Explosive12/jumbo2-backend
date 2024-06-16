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
        $this->orderrepository = new OrderRepository();
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

    public function getAllOrders($currentUserId, $offset = NULL, $limit = NULL, )
    {
        return $this->orderrepository->getAllOrders($currentUserId, $offset, $limit);
    }

    public function insert($order)
    {
        return $this->orderrepository->startOrder($order);
    }

    public function insertOrderItem($orderItem)
    {
        return $this->orderitemrepository->insert($orderItem);
    }


}