<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
</head>
<body>
    <form action="/employers.php?action=new" method="post">
        <label for="newName">New Name:</label>
        <input type="text" id="newName" name="newName"> <!-- Уберите лишние кавычки здесь -->

        <label for="newPassport">New Passport:</label>
        <input type="text" id="newPassport" name="newPassport"> <!-- Уберите лишние кавычки здесь -->

        <label for="newAvatar">New Avatar URL:</label>
        <input type="text" id="newAvatar" name="newAvatar"> <!-- Уберите лишние кавычки здесь -->

        <label for="newDateOfBirth">New Date of Birth:</label>
        <input type="date" id="newDateOfBirth" name="newDateOfBirth"> <!-- Уберите лишние кавычки здесь -->

        <input type="submit" value="New Emp">
    </form>

</body>
</html>