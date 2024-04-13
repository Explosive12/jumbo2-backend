<?php
namespace Models;

enum Userrole: int
{
    case Admin = 1;
    case User = 2;
    case Guest = 3;
}