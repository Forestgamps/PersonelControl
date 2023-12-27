<?php
session_start();

require_once __DIR__.'/controllers/EmpController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$empController = new EmpController();
// $controller->handleRequest();

switch ($action) {
    case 'index':
        $empController->index();
        break;
    case 'view':
        $employeeId = isset($_GET['id']) ? $_GET['id'] : null;
        $empController->view($employeeId);
        break;
    case 'update':
        $employeeId = isset($_GET['id']) ? $_GET['id'] : null;
        $empController->update($employeeId);
        break;
    case 'updateDetails':
        $employeeId = isset($_GET['id']) ? $_GET['id'] : null;
        $empController->updateDetails($employeeId);
        break;
    case 'new':
        $empController->new();
        break;
    case 'newView':
        $empController->newView();
        break;
    default:
        echo 'Invalid action.';
}

?>