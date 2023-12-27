<?php
// Инициализируем сессию
session_start();

// Простой способ сделать глобально доступным подключение в БД
function get_mysqli(): mysqli
{
    static $mysqli;

    if (!$mysqli) {
        $config = include __DIR__.'/config.php';
        // Подключение к БД
        $mysqli = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

        // Проверка на ошибку подключения
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
    }

    return $mysqli;
}

function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
          <div class="alert alert-danger mb-3">
              <?=$_SESSION['flash']?>
          </div>
        <?php }
        unset($_SESSION['flash']);
    }
}

function check_auth(): bool
{
    return !!($_SESSION['user_id'] ?? false);
}
