<?php
class Event {
    public $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT e.*, u.username 
            FROM events e 
            LEFT JOIN users u ON e.user_id = u.id 
            ORDER BY e.date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByUserId($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE user_id = ? ORDER BY date DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated($page = 1, $perPage = 5) {
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->prepare("SELECT * FROM events ORDER BY date DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM events");
        return $stmt->fetchColumn();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("
            SELECT e.*, u.username, u.email 
            FROM events e 
            LEFT JOIN users u ON e.user_id = u.id 
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Sửa hàm add: thêm image
    public function add($title, $description, $date, $location, $image, $user_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO events (title, description, date, location, image, user_id) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$title, $description, $date, $location, $image, $user_id]);
    }

    // Sửa hàm edit: hỗ trợ cập nhật ảnh nếu có
    public function edit($id, $title, $description, $date, $location, $image = null) {
        if ($image) {
            $stmt = $this->pdo->prepare("UPDATE events SET title = ?, description = ?, date = ?, location = ?, image = ? WHERE id = ?");
            return $stmt->execute([$title, $description, $date, $location, $image, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE events SET title = ?, description = ?, date = ?, location = ? WHERE id = ?");
            return $stmt->execute([$title, $description, $date, $location, $id]);
        }
    }

    public function delete($id) {
        // Lấy thông tin sự kiện để lấy tên file hình ảnh
        $event = $this->getById($id);
        if (!$event) {
            return false;
        }
    
        // Xóa file hình ảnh nếu tồn tại
        if (!empty($event['image'])) {
            $imagePath = ROOT . '/public/upload/events/' . $event['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Xóa file
            }
        }
    
        // Xóa bản ghi trong database
        $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
