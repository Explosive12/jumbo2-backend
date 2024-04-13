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

    // checks if the jwt is still valid, if true refreshes the jwt
    public function verify()
    {
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            $this->respond(["valid" => false]);
            return;
        }

        $user = $this->service->getByUsernameOrEmail($decoded->sub, null);
        if (!$user) {
            $this->respondWithError(404, "User not found");
            return;
        }
        $user->role = $decoded->role;
        $_SESSION["user"] = $user;


        $this->respond(["valid" => true, "jwt" => $this->createJwt($user), "user" => $user]);
    }

    public function register()
    {
        $userData = $this->createObjectFromPostedJson('Models\\User');
        $usertaken = $this->service->getByUsernameOrEmail($userData->username, $userData->email);

        if ($usertaken) {
            $this->respondWithError(409, "Username and/or email already taken");
            return;
        }

        $userData->password = $this->service->hashPassword($userData->password);
        $userData->role = UserRole::User->value;
        $user = $this->service->insert($userData);
        $_SESSION["user"] = $user;

        $jwt = $this->createJwt($user);

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
        $jwt = $this->createJwt($user);
        $this->respond(["jwt" => $jwt, "user" => $user]);
    }

    public function createJwt($user)
    {
        $key = "Example_key";
        $payload = array(
            "iss" => "http://api.inholland.nl",
            "aud" => "http://www.inholland.nl",
            "sub" => $user->username,
            "role" => $user->role,
            "iat" => time(),
            "nbf" => time(),
            "exp" => time() + 3600,
        );

        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}
