<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks for Employee</title>
</head>
<body>
    <?php if ($_SESSION['role']=="admin"): ?>
    <form action="/tasks.php?action=create" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="employeeId">Assign to Employee:</label>
        <select name="employeeId" required>
        <?php foreach ($employees as $employee): ?>
            <option value="<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></option>
        <?php endforeach; ?>
        </select>

        <input type="submit" value="Create Task">
    </form>

    <?php endif; ?>

    <h2>Tasks for Employee</h2>

    <?php if (empty($tasks)): ?>
        <p>No tasks assigned.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                    <p><?php echo htmlspecialchars($task['description']); ?></p>
                    <p>Created at: <?php echo htmlspecialchars($task['created_at']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="../">To Main Page</a>
</body>
</html>
