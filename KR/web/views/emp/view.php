<style>
    .avatar-container {
        width: 256px; /* Замените на желаемую ширину */
        height: 256px; /* Замените на желаемую высоту */
        overflow: hidden;
        border-radius: 50%;
        position: relative;
    }

    .avatar-container img {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
</head>
<body>
    <h2>Employee Details</h2>
    <!-- Отобразить информацию о сотруднике -->
    <div class="avatar-container"><p><img src="<?php echo $employee['avatar_url']; ?>" alt="Avatar"></p></div>
    <p>Name: <?php echo $employee['name']; ?></p>
    <p>Date of Birth: <?php echo $employee['dateBirth']; ?></p>
    <p>Passport: <?php echo $employee['passport']; ?></p>
    <p>Salary: <?php echo $employee['salary']; ?></p>
    <p>Speciality: <?php echo $specialityName['name']; ?></p>

    <?php if ($_SESSION['empl_id'] == $employee['id']): ?>
        <form action="/employers.php?action=updateDetails&id=<?php echo $employee['id']; ?>" method="post">
            <!-- Добавьте поля для редактирования паспорта, имени, аватара, даты рождения -->
            <label for="newName">New Name:</label>
            <input type="text" id="newName" name="newName" value="<?php echo $employee['name']; ?>">

            <label for="newPassport">New Passport:</label>
            <input type="text" id="newPassport" name="newPassport" value="<?php echo $employee['passport']; ?>">

            <label for="newAvatar">New Avatar URL:</label>
            <input type="text" id="newAvatar" name="newAvatar" value="<?php echo $employee['avatar_url']; ?>">

            <label for="newDateOfBirth">New Date of Birth:</label>
            <input type="date" id="newDateOfBirth" name="newDateOfBirth" value="<?php echo $employee['dateBirth']; ?>">

            <input type="submit" value="Update">
        </form>

    <?php endif; ?>

    <?php if ($_SESSION['role'] == "admin"): ?>
        <!-- Отобразить форму редактирования (если пользователь - админ или это его сотрудник) -->
        <form action="/employers.php?action=update&id=<?php echo $employee['id']; ?>" method="post">
            <!-- Добавьте поля для редактирования зарплаты, должности и т.д. -->
            <label for="newSalary">New Salary:</label>
            <input type="text" id="newSalary" name="newSalary" value="<?php echo $employee['salary']; ?>">

            <label for="newSpeciality">Speciality:</label>
            <select name="newSpeciality" required>
            <?php foreach ($specialities as $speciality): ?>
            <option value="<?php echo $speciality['id']; ?>"><?php echo $speciality['name']; ?></option>
            <?php endforeach; ?>
            </select><br>

            <input type="submit" value="Update">
        </form>
    <?php endif; ?>
    <a href="../">To Main Page</a>
</body>
</html>