<?php
class AuthController {
    private $user;

    public function __construct() {
        require_once ROOT . '/app/models/User.php';
        $this->user = new User();
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if($this->user->login($username, $password)) {
                header("Location: ?controller=event&action=index");
                exit();
            } else {
                $error = "Đăng nhập thất bại!";
            }
        }
        require_once ROOT . '/app/views/auth/login.php';
    }

    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if($this->user->register($username, $password)) {
                header("Location: ?controller=auth&action=login");
                exit();
            } else {
                $error = "Đăng ký thất bại!";
            }
        }
        require_once ROOT . '/app/views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: ?controller=auth&action=login");
        exit();
    }
}
?>