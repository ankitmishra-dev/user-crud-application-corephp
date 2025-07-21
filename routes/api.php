<?php
spl_autoload_register(function ($className) {
    $folders = ['controllers', 'database'];
    foreach ($folders as $folder) {
        $file = __DIR__ . "/../$folder/$className.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});


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
