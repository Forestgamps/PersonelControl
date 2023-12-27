<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>работники</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 256px;  /* Ограничение ширины изображения для удобства отображения */
            max-height: 256px; /* Ограничение высоты изображения для удобства отображения */
        }
    </style>
</head>
<body>
    <?php
    $servername = "database";
    $username = "user";
    $password = "password";
    $dbname = "personel";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($_SESSION["role"] == "admin") {
            $id = $_GET['id'];

            if (empty($id)) {
                $result = ($conn->query("SELECT * FROM empl"));
            } else {
                $result = $conn->query("SELECT * FROM empl where id = $id");
            }

            echo '<table>';
            echo '<tr><th>ID</th><th>Name</th><th>Date of Birth</th><th>Passport</th><th>Salary</th><th>Speciality ID</th><th>Avatar</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['dateBirth'] . '</td>';
                echo '<td>' . $row['passport'] . '</td>';
                echo '<td>' . $row['salary'] . '</td>';
                echo '<td>' . $row['speciality_id'] . '</td>';
                echo '<td><img src="' . $row['avatar_url'] . '" alt="Avatar"></td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "Page not found";
        }
    }

    $conn->close();
    ?>
</body>
</html>
