<?php

require_once __DIR__ . '/../boot.php';

class UserModel {
    
    private $mysqli;

    public function __construct() {
        $this->mysqli = get_mysqli();
    }

    public function getUserById($userId) {
        $stmt = $this->mysqli->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }

    public function getUserByName($userName){
        $stmt = $this->mysqli->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $stmt->bind_param('s', $userName);
        $stmt->execute();
        $result = $stmt->get_result();
        // var_dump($result);
        $stmt->close();
        return $result;
    }

    public function addUser($userName, $userPassword){
        $stmt = $this->mysqli->prepare("INSERT INTO `users` (`username`, `password`) VALUES (?, ?)");
        $stmt->bind_param('ss', $userName, password_hash($userPassword, PASSWORD_DEFAULT));
        $stmt->execute();
        // if ($stmt->execute()) {
        //     echo 'Все добавлено бро';
        // } else {
        //     echo 'Ошибка: ' . $stmt->error;
        // };
        $stmt->close();
    }
}
