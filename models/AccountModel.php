<?php

class AccountModel extends BaseModel {
    public function getUserId($username){
        $statement = self::$db->prepare("SELECT id FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }

    public function register($username, $password, $name) {
        $statement = self::$db->prepare("SELECT COUNT(id) FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if($result['COUNT(id)']){
            return false;
        }

        $hashPass = password_hash($password, PASSWORD_BCRYPT);

        $registerStatement = self::$db->prepare("INSERT INTO users (username, password_hash, name, register_date) VALUES (?, ?, ?, ?)");
        $date = date('Y-m-d H:m:s', time());
        $registerStatement->bind_param("ssss", $username, $hashPass, $name, $date);
        $registerStatement->execute();

        return true;
    }

    public function login($username, $password){
        $statement = self::$db->prepare("SELECT * FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if(password_verify($password, $result['password_hash'])) {
            return true;
        }

        return false;
    }
}