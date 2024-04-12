<?php
namespace Models;

class Order
{
    public int $id;
    public int $userid;
    public string $status;
    public string $date;
    public float $total;
}