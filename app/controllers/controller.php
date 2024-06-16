<?php

namespace Controllers;

use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Controller
{

    public function generateToken($user): string
    {
        $key = "Jumbo_key";
        $payload = array(
            "iss" => "http://api.jumbo.nl",
            "aud" => "http://www.jumbo.nl",
            "sub" => $user->username,
            "role" => $user->role,
            "email" => $user->email,
            "iat" => time(),
            "nbf" => time(),
            "exp" => time() + 60 * 60 * 24 * 30,
        );

        return JWT::encode($payload, $key, 'HS256');
    }

    function checkForJwt()
    {
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->respondWithError(401, "No token provided");
            return;
        }

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $arr = explode(" ", $authHeader);
        $jwt = $arr[1];

        // Decode JWT
        $secret_key = "Jumbo_key";

        if ($jwt) {
            try {
                return JWT::decode($jwt, new Key($secret_key, 'HS256'));
            } catch (Exception $e) {
                $this->respondWithError(401, $e->getMessage());
                return;
            }
        }
    }


    function getUsernameFromJwt()
    {
        $decoded = $this->checkForJwt();
        return $decoded->sub;
    }

    function respond($data): void
    {
        $this->respondWithCode(200, $data);
    }

    function respondWithError($httpCode, $message): void
    {
        $data = array('errorMessage' => $message);
        $this->respondWithCode($httpCode, $data);
    }

    private function respondWithCode($httpCode, $data): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpCode);
        echo json_encode($data);
    }

    function userIsAdmin(): bool
    {
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return false;
        }
        return $decoded->role == 1;
    }

    function userIsOwner($userId)
    {
        $decoded = $this->checkForJwt();
        if (!$decoded) {
            return false;
        }
        return $decoded->sub == $userId;
    }

    function createObjectFromPostedJson($className)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $object = new $className();
        foreach ($data as $key => $value) {
            if (is_object($value)) {
                continue;
            }
            $object->{$key} = $value;
        }
        return $object;
    }
}
