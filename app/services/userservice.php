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

    public function getAll($currentUserId, $offset = NULL, $limit = NULL, )
    {
        return $this->repository->getAll($currentUserId, $offset, $limit);
    }

    public function getOne($id)
    {
        return $this->repository->getOne($id);
    }

    public function getByUsernameOrEmail($username, $email)
    {
        return $this->repository->getByUsernameOrEmail($username, $email);
    }

    public function insert($user)
    {
        return $this->repository->insert($user);
    }

    public function update($user)
    {
        return $this->repository->update($user);
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