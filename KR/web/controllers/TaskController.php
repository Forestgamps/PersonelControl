<?php

require_once __DIR__ . '/../boot.php';
require_once __DIR__ . '/../models/TaskModel.php';
require_once __DIR__ . '/../models/EmpModel.php';

class TaskController {
    private $taskModel;
    private $empModel;

    public function __construct() {
        $this->taskModel = new TaskModel();
        $this->empModel = new EmpModel();
    }

    public function createTask() {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $employeeId = $_POST["employeeId"];

        // Создание задачи
        $taskId = $this->taskModel->createTask($title, $description, $employeeId);

        // Редирект или другая логика
        if ($taskId !== null) {
            header('Location: /tasks.php');
        } else {
            // Обработка ошибки
            echo "Error creating task.";
        }
    }

    public function viewTasksForEmployee($employeeId) {
        $tasks = $this->taskModel->getTasksForEmployee($employeeId);
        $employees = $this->empModel->getAllEmp();

        include __DIR__ . '/../views/task/index.php';
    }
}
?>
