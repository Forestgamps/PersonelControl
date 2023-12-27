<?php
require_once __DIR__ . '/../boot.php';
require_once __DIR__ . '/../models/UserModel.php';

class HomeController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Обработка GET-запроса
            $this->handleGetRequest();
        }
        elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->handlePostRequest();
        }
    }

    private function handleGetRequest() {
        if (check_auth()) {
            include __DIR__ .'/../views/HomeViewReg.php';
        }
        else {
            include __DIR__ .'/../views/HomeViewUnreg.php';
        }
    }

    private function handlePostRequest()
    {
        $result = $this->userModel->getUserByName($_POST['username']);

        if ($result->num_rows === 0) {
            flash('Пользователь с такими данными не зарегистрирован');
            header('Location: /');
            die;
        }

        $user = $result->fetch_assoc();

        // проверяем пароль
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['empl_id'] = $user['empl_id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /');
            die;
        }
            flash('Пароль неверен');
            header('Location: /');
    }
}
