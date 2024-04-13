<?php
namespace Models;

enum OrderStatus: int
{
    case Pending = 1;
    case Fulfilled = 2;
    case Cancelled = 3;
}