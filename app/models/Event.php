<?php
class Event {
    public $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM events ORDER BY date DESC");
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
        $stmt = $this->pdo->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Sửa hàm add: thêm image
    public function add($title, $description, $date, $location, $image = null) {
        $stmt = $this->pdo->prepare("INSERT INTO events (title, description, date, location, image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $date, $location, $image]);
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
        $stmt = $this->pdo->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
