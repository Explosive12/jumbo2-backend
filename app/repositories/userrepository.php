<?php

namespace Repositories;

use Models\Userrole;
use PDO;
use PDOException;
use Repositories\Repository;

class UserRepository extends Repository
{

    function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT * FROM user";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $users = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                $users[] = $this->rowToUser($row);
            }

            return $users;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function rowToUser($row)
    {
        $user = new \Models\User();
        $user->id = $row['id'];
        $user->username = $row['username'];
        $user->password = $row['password'];
        $user->email = $row['email'];
        $user->role = $row['role'];
        return $user;
    }
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

    function update($user)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE user SET username = :username, password = :password, email = :email, role = :role WHERE id = :id");
            $stmt->bindParam(':username', $user->username);
            $stmt->bindParam(':password', $user->password);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':role', $user->role, PDO::PARAM_INT);
            $stmt->bindParam(':id', $user->id);
            $stmt->execute();

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
