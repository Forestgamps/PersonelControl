<?php
require_once __DIR__.'/../boot.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../controllers/RegController.php';

$user = null;
$userModel = new UserModel();


if (check_auth()) {
    // Получим данные пользователя по сохранённому идентификатору
    $user = $userModel->getUserById($_SESSION['user_id']);
}
?>
<?php if ($user) { ?>

    <h1>Welcome back, <?=htmlspecialchars($user['username'])?>!</h1>

    <form class="mt-5" method="post" action="do_logout.php">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>

<?php } else { ?>

    <h1 class="mb-5">Registration</h1>

    <?php flash(); ?>

    <form method="post" action="">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
    </form>

<?php } ?>
