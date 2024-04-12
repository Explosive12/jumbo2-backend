<?php
namespace Services;

use Repositories\UserRepository;

class UserService
{

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getByUsernameOrEmail($username, $email)
    {
        return $this->repository->getByUsernameOrEmail($username, $email);
    }

    public function insert($user)
    {
        return $this->repository->insert($user);
    }

    public function hashPassword($password)
    {
        return $this->repository->hashPassword($password);
    }

    public function checkUsernamePassword($username, $password)
    {
        return $this->repository->checkUsernamePassword($username, $password);
    }
}

?>