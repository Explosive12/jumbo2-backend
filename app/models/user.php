<?php
namespace Models;

use Models\Userrole;

class User
{
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public int $role;
}