<?php
session_start();
?>

<?php
// Assuming your database connection parameters
$servername = "database";
$username = "user";
$password = "password";
$dbname = "personel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch specialities for dropdown
$sqlSpecialities = "SELECT id, name FROM speciality";
$resultSpecialities = $conn->query($sqlSpecialities);
$specialities = [];
while ($row = $resultSpecialities->fetch_assoc()) {
    $specialities[] = $row;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $dateBirth = $_POST["dateBirth"];
    $passport = $_POST["passport"];
    $salary = $_POST["salary"];
    $selectedSpecialityId = $_POST["speciality_id"];
    $avatarUrl = $_POST["avatarUrl"]; // New field for avatar URL

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO empl (name, dateBirth, passport, salary, speciality_id, avatar_url) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssds", $name, $dateBirth, $passport, $salary, $selectedSpecialityId, $avatarUrl);
    
    if ($stmt->execute()) {
        // Get the last inserted id
        $lastInsertId = mysqli_insert_id($conn);

        // Update the user record with empl_id
        $updateUserSql = "UPDATE users SET empl_id = ? WHERE id = ?";
        $stmtUpdateUser = $conn->prepare($updateUserSql);
        $stmtUpdateUser->bind_param("ii", $lastInsertId, $_SESSION['user_id']);
        $stmtUpdateUser->execute();
        $stmtUpdateUser->close();

        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>

<h2>Add Employee</h2>

<form action="newemp.php" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="dateBirth">Date of Birth:</label>
    <input type="date" name="dateBirth" required><br>

    <label for="passport">Passport:</label>
    <input type="text" name="passport" required><br>

    <label for="salary">Salary:</label>
    <input type="text" name="salary" required><br>

    <label for="speciality_id">Speciality:</label>
    <select name="speciality_id" required>
        <?php foreach ($specialities as $speciality): ?>
            <option value="<?php echo $speciality['id']; ?>"><?php echo $speciality['name']; ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="avatarUrl">Avatar URL:</label>
    <input type="text" name="avatarUrl"><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
