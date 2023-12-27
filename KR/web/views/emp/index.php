<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            color: #007bff;
        }

        ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        li {
            margin: 10px;
            text-align: center;
        }

        .avatar-container {
            width: 80px;
            height: 80px;
            overflow: hidden;
            border-radius: 12px; /* Задайте радиус скругления углов */
            margin: 0 auto;
        }

        .avatar-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>


</head>
<body>
    <h2>Employee List</h2>
    <!-- Отобразить список сотрудников -->
    <ul>
        <?php foreach ($employees as $employee): ?>
            <li>
                <a href="/employers.php?action=view&id=<?php echo $employee['id']; ?>">
                    <div class="avatar-container">
                        <img src="<?php echo $employee['avatar_url']; ?>" alt="Avatar">
                    </div>
                    <p><?php echo $employee['name']; ?></p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="../">To Main Page</a>
</body>
</html>
