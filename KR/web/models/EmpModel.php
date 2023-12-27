<?php

require_once __DIR__ . '/../boot.php';

class EmpModel {
    
    private $mysqli;

    public function __construct() {
        $this->mysqli = get_mysqli();
    }

    public function getAllEmp() {
        $stmt = $this->mysqli->prepare("SELECT * FROM empl");
        $stmt->execute();

        $result = $stmt->get_result();
        $emps = $result;
        $stmt->close();
        return $emps;
    }

    public function getEmpById($empId) {
        $stmt = $this->mysqli->prepare("SELECT * FROM empl WHERE `id` = ?");
        $stmt->bind_param('i', $empId);
        $stmt->execute();

        $result = $stmt->get_result();
        $emp = $result->fetch_assoc();
        $stmt->close();
        return $emp;
    }

    public function updateEmpSalarySpeciality($employeeId, $newSalary, $newSpeciality) {
        $stmt = $this->mysqli->prepare("UPDATE empl SET salary = ?, speciality_id = ? WHERE id = ?");
        $stmt->bind_param('dii', $newSalary, $newSpeciality, $employeeId);
        $stmt->execute();
        $stmt->close();
    }

    public function updateEmpDetails($employeeId, $newName, $newPassport, $newAvatar, $newDateOfBirth) {
        $stmt = $this->mysqli->prepare("UPDATE empl SET name = ?, passport = ?, avatar_url = ?, dateBirth = ? WHERE id = ?");
        $stmt->bind_param('ssssi', $newName, $newPassport, $newAvatar, $newDateOfBirth, $employeeId);
        $stmt->execute();
        $stmt->close();
    }

    public function getSpeciality(){
        $stmt = $this->mysqli->prepare("SELECT id, name FROM speciality");
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getSpecialityNameById($specialityId) {
        $stmt = $this->mysqli->prepare("SELECT name FROM speciality WHERE `id` = ?");
        $stmt->bind_param('i', $specialityId);
        $stmt->execute();

        $result = $stmt->get_result();
        $spec = $result->fetch_assoc();
        $stmt->close();
        return $spec;
    }

    public function createNewEmployee($name, $passport, $avatar, $dateOfBirth) {
        $stmt = $this->mysqli->prepare("INSERT INTO empl (name, passport, avatar_url, dateBirth) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $passport, $avatar, $dateOfBirth);
        if($stmt->execute()){
            $lastInsertId = mysqli_insert_id($this->mysqli);

            // Update the user record with empl_id
            $updateUserSql = "UPDATE users SET empl_id = ? WHERE id = ?";
            $stmtUpdateUser =$this->mysqli->prepare($updateUserSql);
            $stmtUpdateUser->bind_param("ii", $lastInsertId, $_SESSION['user_id']);
            $stmtUpdateUser->execute();
            $stmtUpdateUser->close();
        }
        $stmt->close();

        return $lastInsertId;
    }
    

    public function addEmp($userName, $userPassword){
        $stmt = $this->mysqli->prepare("INSERT INTO `users` (`username`, `password`) VALUES (?, ?)");
        $stmt->bind_param('ss', $userName, password_hash($userPassword, PASSWORD_DEFAULT));
        $stmt->execute();
        // if ($stmt->execute()) {
        //     echo 'Все добавлено бро';
        // } else {
        //     echo 'Ошибка: ' . $stmt->error;
        // };
        $stmt->close();
    }
}
