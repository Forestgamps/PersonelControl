<?php

class TaskModel {
    private $mysqli;

    public function __construct() {
        $this->mysqli = get_mysqli();
    }

    public function createTask($title, $description, $employeeId) {
        $stmt = $this->mysqli->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
        $stmt->bind_param('ss', $title, $description);
        
        if ($stmt->execute()) {
            $taskId = mysqli_insert_id($this->mysqli);

            // Связываем задачу с сотрудником
            $this->assignTaskToEmployee($taskId, $employeeId);

            $stmt->close();
            return $taskId;
        } else {
            // Обработка ошибки
            return null;
        }
    }

    public function getTasksForEmployee($employeeId) {
        $query = "SELECT tasks.id, tasks.title, tasks.description, tasks.created_at
                  FROM tasks
                  JOIN employee_tasks ON tasks.id = employee_tasks.task_id
                  WHERE employee_tasks.employee_id = ?";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $employeeId);
        $stmt->execute();

        $result = $stmt->get_result();
        $tasks = [];

        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }

        $stmt->close();
        return $tasks;
    }

    private function assignTaskToEmployee($taskId, $employeeId) {
        $stmt = $this->mysqli->prepare("INSERT INTO employee_tasks (task_id, employee_id) VALUES (?, ?)");
        $stmt->bind_param('ii', $taskId, $employeeId);
        $stmt->execute();
        $stmt->close();
    }
}
?>
