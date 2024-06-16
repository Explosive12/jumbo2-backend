<?php

namespace Controllers;

use Models\Userrole;
use Models\User;
use Services\UserService;

class AdminController extends Controller
{

    private $service;

    function __construct()
    {
        $this->service = new UserService();
    }

    public function getAllUsers()
    {

        if(!$this->userIsAdmin()) {
            $this->respondWithError(401, "Unauthorized");
            return;
        }

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $username = $this->getUsernameFromJwt();

        $currentUserId = $this->service->getByUsernameOrEmail($username, $username)->id;

        $users = $this->service->getAll($currentUserId, $offset, $limit, );

        $this->respond($users);
    }

    public function updateUser($id)
    {
        if(!$this->userIsAdmin()) {
            $this->respondWithError(401, "Unauthorized");
            return;
        }

        $user = $this->service->getOne($id);

        if (!$user) {
            $this->respondWithError(404, "User not found");
            return;
        }

        $userData = $this->createObjectFromPostedJson('Models\\User');

        $user->username = $userData->username;
        $user->email = $userData->email;
        $user->role = $userData->role;

        $this->service->update($user);

        $this->respond($user);
    }

}