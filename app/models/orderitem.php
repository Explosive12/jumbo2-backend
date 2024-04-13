<?php
namespace Models;

class Orderitem
{
    public int $id;
    public int $orderid;
    public int $productid;
    public int $quantity;
    public float $price;

    function __construct($id, $orderid, $productid, $quantity, $price)
    {
        $this->id = $id;
        $this->orderid = $orderid;
        $this->productid = $productid;
        $this->quantity = $quantity;
        $this->price = $price;
    }
}