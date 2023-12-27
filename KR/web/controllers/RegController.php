<?php
require_once __DIR__ . '/../boot.php';
require_once __DIR__ . '/../models/UserModel.php';

class RegController {
    
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->handleGetRequest();
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->handlePostRequest();
        }
    }

    private function handleGetRequest() {
        if (!check_auth()) {
            include __DIR__ . '/../views/RegView.php';
        }
        else {
            header('Location: /');
        }
    }

    private function handlePostRequest()
    {
        $userName = $this->userModel->getUserByName($_POST['username']);
        // var_dump($userName);
        if ($userName->num_rows > 0) {
            flash('Это имя пользователя уже занято.');
            header('Location: /'); // Возврат на форму регистрации
            exit; // Используем exit вместо die
        }
        else{
            header('Location: /');
            $this->userModel->addUser($_POST['username'], $_POST['password']);
            // var_dump($this->userModel);
            
            exit; // Используем exit вместо die
            //include __DIR__ .'/../views/HomeViewReg.php';
        }
    }
}