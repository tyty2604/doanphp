<?php
class Feedback {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Thêm phản hồi mới
    public function create($user_id, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO feedbacks (user_id, content) VALUES (?, ?)");
        return $stmt->execute([$user_id, $content]);
    }

    // Lấy tất cả phản hồi (cho admin)
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT f.*, u.username 
            FROM feedbacks f 
            LEFT JOIN users u ON f.user_id = u.id 
            ORDER BY f.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa phản hồi
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM feedbacks WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getUnreadCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM feedbacks WHERE is_read = 0");
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
}
?>