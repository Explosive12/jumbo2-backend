<?php
namespace Models;


class Product
{
    public int $id;
    public string $name;
    public float $price;
    public string $description;
    public string $image;
    public int $stock;
    public int $category_id;
    public Category $category;
}