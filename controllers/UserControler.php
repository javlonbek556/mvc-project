<?php

require_once '../models/User.php';

class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            if ($user->register($name, $email, $password)) {
                header("Location: /login");
                exit();
            } else {
                echo "Registration failed!";
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $loggedInUser = $user->login($email, $password);
            if ($loggedInUser) {
                session_start();
                $_SESSION['user_id'] = $loggedInUser['id'];
                header("Location: /posts");
                exit();
            } else {
                echo "Invalid credentials!";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /login");
        exit();
    }
}
?>
