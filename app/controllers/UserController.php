<?php
class UserController {
    private $user;
    private $current_role;

    public function __construct() {
        require_once ROOT . '/app/models/User.php';
        $this->user = new User();

        if (!isset($_SESSION['user_id'])) {
            header("Location: ?controller=auth&action=login");
            exit();
        }

        $this->current_role = $this->user->getRole($_SESSION['user_id']);
        // Chỉ admin được truy cập
        if ($this->current_role !== 'admin') {
            $_SESSION['error'] = "Bạn không có quyền truy cập trang này!";
            header("Location: ?controller=event&action=index");
            exit();
        }
    }

    public function index() {
        $users = $this->user->getAll();
        require_once ROOT . '/app/views/users/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
            $role = $_POST['role'] ?? 'user';

            if ($this->user->add($username, $email, $password, $role)) {
                $_SESSION['success'] = "Thêm người dùng thành công!";
                header("Location: ?controller=user&action=index");
                exit();
            } else {
                $_SESSION['error'] = "Thêm người dùng thất bại!";
            }
        }
        require_once ROOT . '/app/views/users/add.php';
    }

    public function edit($id) {
        $user = $this->user->getById($id);
        if (!$user) {
            $_SESSION['error'] = "Không tìm thấy người dùng!";
            header("Location: ?controller=user&action=index");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

            if ($this->user->edit($id, $username, $email, $role, $password)) {
                $_SESSION['success'] = "Cập nhật người dùng thành công!";
                header("Location: ?controller=user&action=index");
                exit();
            } else {
                $_SESSION['error'] = "Cập nhật người dùng thất bại!";
            }
        }
        require_once ROOT . '/app/views/users/edit.php';
    }

    public function delete($id) {
        if ($id == $_SESSION['user_id']) {
            $_SESSION['error'] = "Bạn không thể xóa chính mình!";
            header("Location: ?controller=user&action=index");
            exit();
        }

        if ($this->user->delete($id)) {
            $_SESSION['success'] = "Xóa người dùng thành công!";
        } else {
            $_SESSION['error'] = "Xóa người dùng thất bại!";
        }
        header("Location: ?controller=user&action=index");
        exit();
    }
}
?>