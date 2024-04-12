<?php

namespace Repositories;

use Models\Userrole;
use PDO;
use PDOException;
use Repositories\Repository;

class UserRepository extends Repository
{
    function checkUsernamePassword($username, $password)
    {
        try {
            // retrieve the user with the given username
            $stmt = $this->connection->prepare("SELECT id, username, password, role FROM user WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            if (!$user) {
                return false;
            }
            $result = $this->verifyPassword($password, $user->password);

            if (!$result)
                return false;

            $user->password = "";

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getByUsernameOrEmail($username, $email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, username, password, email, role FROM user WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($user)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)");
            $stmt->bindParam(':username', $user->username);
            $stmt->bindParam(':password', $user->password);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':role', $user->role, PDO::PARAM_INT);
            $stmt->execute();

            $user->id = $this->connection->lastInsertId();
            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }
}
