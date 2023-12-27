<?php
session_start();

require_once __DIR__.'/controllers/TaskController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$taskController = new TaskController();
// $controller->handleRequest();

switch ($action) {
    case 'index':
        $taskController->viewTasksForEmployee($_SESSION['empl_id']);
        break;
    case 'create':
        $taskController->createTask();
        break;
    // case 'update':
    //     $employeeId = isset($_GET['id']) ? $_GET['id'] : null;
    //     $empController->update($employeeId);
    //     break;
    // case 'updateDetails':
    //     $employeeId = isset($_GET['id']) ? $_GET['id'] : null;
    //     $empController->updateDetails($employeeId);
    //     break;
    // case 'new':
    //     $empController->new();
    //     break;
    // case 'newView':
    //     $empController->newView();
    //     break;
    default:
        echo 'Invalid action.';
    }
