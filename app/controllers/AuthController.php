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
            $email = $_POST['email']; // Thêm dòng này để lấy email từ form

            // Kiểm tra các trường bắt buộc
            if(empty($username) || empty($password) || empty($email)) {
                $error = "Vui lòng điền đầy đủ thông tin!";
                require_once ROOT . '/app/views/auth/register.php';
                return;
            }

            // Kiểm tra định dạng email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Địa chỉ email không hợp lệ!";
                require_once ROOT . '/app/views/auth/register.php';
                return;
            }

            // Đăng ký với email mới
            if($this->user->register($username, $password, $email)) {
                $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
                header("Location: ?controller=auth&action=login");
                exit();
            } else {
                $error = "Đăng ký thất bại! Tên đăng nhập hoặc email đã tồn tại.";
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