<?php
namespace Models;

enum OrderStatus: int
{
    case Fulfilled = 2;
    case Cancelled = 1;
}