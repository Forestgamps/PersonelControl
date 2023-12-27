<?php
require_once __DIR__ . '/../boot.php';
require_once __DIR__ . '/../models/EmpModel.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class EmpController {
    
    private $empModel;

    public function __construct() {
        $this->empModel = new EmpModel();
    }

    public function index() {
        // Отобразить список сотрудников
        $employees = $this->empModel->getAllEmp();

        // Вывести список сотрудников с возможностью редактирования (если пользователь - админ)
        // или только просмотра (если пользователь не админ)
        include __DIR__ . '/../views/emp/index.php';
    }

    public function view($employeeId) {
        // Отобразить информацию о конкретном сотруднике по ID
        $employee = $this->empModel->getEmpById($employeeId);
        $specialities = $this->empModel->getSpeciality($employeeId);
        $specialityName = $this->empModel->getSpecialityNameById($employee['speciality_id']);
        // Проверка прав доступа - если пользователь админ или это его сотрудник, отобразить форму редактирования
        // иначе - только просмотр
        include __DIR__ . '/../views/emp/view.php';
    }

    public function update($employeeId) {
        $newSalary = $_POST['newSalary'];
        $newSpeciality = $_POST['newSpeciality'];
        $this->empModel->updateEmpSalarySpeciality($employeeId, $newSalary, $newSpeciality);
        // Редирект обратно к странице просмотра
        header('Location: /employers.php?action=view&id=' . $employeeId);
    }

    public function updateDetails($employeeId) {
        $newName = $_POST['newName'];
        $newPassport = $_POST['newPassport'];
        $newAvatar = $_POST['newAvatar'];
        $newDateOfBirth = $_POST['newDateOfBirth'];
        $this->empModel->updateEmpDetails($employeeId, $newName, $newPassport, $newAvatar, $newDateOfBirth);
        // Редирект обратно к странице просмотра
        header('Location: /employers.php?action=view&id=' . $employeeId);
    }

    public function newView() {
        include __DIR__ . '/../views/emp/newView.php';
    }

    public function new() {
        $newName = $_POST['newName'];
        $newPassport = $_POST['newPassport'];
        $newAvatar = $_POST['newAvatar'];
        $newDateOfBirth = $_POST['newDateOfBirth'];
        $lastInsertId = $this->empModel->createNewEmployee($newName, $newPassport, $newAvatar, $newDateOfBirth);
        $_SESSION['empl_id'] == $lastInsertId;
        // Редирект обратно к странице просмотра
        if($lastInsertId != null){
            header('Location: /employers.php?action=view&id=' . $lastInsertId);
            
        }
        else {
            header('Location: /');
        }
    }
}