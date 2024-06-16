<?php

namespace Controllers;

use Services\UserService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Models\Userrole;

class UserController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new UserService();
    }

    public function register()
    {
        $userData = $this->createObjectFromPostedJson('Models\\User');
        $userTaken = $this->service->getByUsernameOrEmail($userData->username, $userData->email);

        if ($userTaken) {
            $this->respondWithError(409, "Username and/or email already taken");
            return;
        }

        $userData->password = $this->service->hashPassword($userData->password);
        $userData->role = UserRole::User->value;
        $user = $this->service->insert($userData);
        $_SESSION["user"] = $user;

        $jwt = $this->generateToken($user);

        $this->respond(["jwt" => $jwt, "user" => $user]);
    }

    function logout()
    {
        $this->respond("Logged out");
    }

    public function login()
    {
        $loginData = $this->createObjectFromPostedJson('Models\\User');
        $user = $this->service->checkUsernamePassword($loginData->username, $loginData->password);

        if (!$user) {
            $this->respondWithError(401, "Incorrect username and/or password");
            return;
        }

        $_SESSION["user"] = $user;
        $jwt = $this->generateToken($user);
        $this->respond(["jwt" => $jwt, "user" => $user]);
    }
}
