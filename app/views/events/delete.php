<?php
// public/delete.php
session_start(); // Khởi tạo session để kiểm tra role
require_once '../app/controllers/EventController.php'; // Bao gồm controller
require_once '../app/config.php'; // Bao gồm file cấu hình database (nếu cần)

// Khởi tạo controller
$controller = new EventController();

// Lấy tham số id từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id === null) {
    die("Error: Event ID is required to delete.");
}

// Gọi phương thức delete trong controller
$controller->delete($id);
?>