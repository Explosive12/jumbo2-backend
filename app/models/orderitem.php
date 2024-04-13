<?php
namespace Models;

class Orderitem
{
    public int $id;
    public int $orderid;
    public int $productid;
    public int $quantity;
    public float $price;
}