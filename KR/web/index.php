<?php
session_start();

require_once __DIR__.'/controllers/HomeController.php';

$controller = new HomeController();
$controller->handleRequest();

?>