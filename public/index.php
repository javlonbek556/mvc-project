<?php

session_start();

require_once '../core/Database.php';
require_once '../controllers/UserController.php';
require_once '../controllers/PostController.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

switch ($uri) {
    case 'login':
        (new UserController())->login();
        break;
    case 'register':
        (new UserController())->register();
        break;
    case 'logout':
        (new UserController())->logout();
        break;
    case 'posts':
        (new PostController())->index();
        break;
    case 'posts/create':
        (new PostController())->store();
        break;
    default:
        header('Location: /login.php');
        exit();
}

?>
