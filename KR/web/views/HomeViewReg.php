<?php 
if ($_SESSION['role']) { ?>

<h1>Welcome, <?=htmlspecialchars($_SESSION['username'])?>!</h1>
<h1>Your role is <?=htmlspecialchars($_SESSION['role'])?>!</h1>

<form class="mt-5" method="post" action="../controllers/LogoutController.php">
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
<?php 
if ($_SESSION['empl_id'] != null) {
    echo '<a href="/employers.php?action=view&id=' . $_SESSION['empl_id'] . '">My profile</a>';
} else {
    echo '<a href="/employers.php?action=newView">New profile</a>';
}
?>

<p></p>
<a href="/employers.php">Employers</a>
<p></p>
<a href="/tasks.php">Tasks</a>
<?php } ?>