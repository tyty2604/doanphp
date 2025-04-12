<?php
class FeedbackController {
    private $feedback;
    private $current_user_id;
    private $current_role;

    public function __construct() {
        require_once ROOT . '/app/models/Feedback.php';
        require_once ROOT . '/app/models/User.php';
        $this->feedback = new Feedback();
        $this->user = new User();

        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập!";
            header("Location: ?controller=auth&action=login");
            exit();
        }

        $this->current_user_id = $_SESSION['user_id'];
        $this->current_role = $this->user->getRole($this->current_user_id);
    }

    // Trang gửi phản hồi
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $content = trim($_POST['content'] ?? '');
            if (empty($content)) {
                $_SESSION['error'] = "Vui lòng nhập nội dung phản hồi!";
            } elseif ($this->feedback->create($this->current_user_id, $content)) {
                $_SESSION['success'] = "Gửi phản hồi thành công!";
                header("Location: ?controller=event&action=index");
                exit();
            } else {
                $_SESSION['error'] = "Gửi phản hồi thất bại!";
            }
        }
        require_once ROOT . '/app/views/feedbacks/create.php';
    }

    // Trang quản lý phản hồi (chỉ dành cho admin)
    public function index() {
        if ($this->current_role !== 'admin') {
            $_SESSION['error'] = "Bạn không có quyền truy cập trang này!";
            header("Location: ?controller=event&action=index");
            exit();
        }

        $feedbacks = $this->feedback->getAll();
        require_once ROOT . '/app/views/feedbacks/index.php';
    }

    // Xóa phản hồi (chỉ dành cho admin)
    public function delete($id) {
        if ($this->current_role !== 'admin') {
            $_SESSION['error'] = "Bạn không có quyền truy cập trang này!";
            header("Location: ?controller=event&action=index");
            exit();
        }

        if ($this->feedback->delete($id)) {
            $_SESSION['success'] = "Xóa phản hồi thành công!";
        } else {
            $_SESSION['error'] = "Xóa phản hồi thất bại!";
        }
        header("Location: ?controller=feedback&action=index");
        exit();
    }
}
?>