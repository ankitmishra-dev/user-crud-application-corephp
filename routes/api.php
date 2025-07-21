<?php

require_once __DIR__ . '/../autoload/Autoloader.php';

$db = new Database();

$conn = $db->getConnection();

$controller = new UserController($conn);

match ($_GET['action'] ?? null) {
    'create' => $controller->createUser(),
    'read'   => $controller->getUsers(),
    'update' => $controller->updateUser(),
    'delete' => $controller->deleteUser(),
    default  => print json_encode(['status' => 'error', 'message' => 'Invalid action']),
};
