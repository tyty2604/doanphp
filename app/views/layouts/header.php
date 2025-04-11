<!-- Header Section -->
<div style="background: linear-gradient(90deg, #4A90E2, #357ABD); width: 100vw; margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%);">
    <div class="d-flex justify-content-between align-items-center py-3 px-4">
        <!-- Tiêu đề với icon -->
        <h1 class="mb-0 d-flex align-items-center text-white">
            <i class="fas fa-calendar-alt me-2"></i>
            <span class="fw-bold">Quản Lý Sự Kiện</span>
        </h1>

        <!-- Phần nút điều hướng -->
        <div class="d-flex align-items-center gap-3">
            <!-- Nút Trang chủ -->
            <a href="?controller=event&action=index" 
               class="btn btn-outline-light btn-sm px-4 py-2 fw-semibold">
                Trang chủ
            </a>

            <?php if(isset($_SESSION['user_id'])): ?>
                <?php 
                    require_once ROOT . '/app/models/User.php';
                    $userModel = new User();
                    $current_role = $userModel->getRole($_SESSION['user_id']);
                ?>
                <?php if($current_role === 'admin'): ?>
                    <a href="?controller=event&action=dashboard" 
                       class="btn btn-outline-light btn-sm px-4 py-2 fw-semibold">
                        Bảng điều khiển
                    </a>
                <?php endif; ?>
                <!-- Nút Đăng xuất nếu người dùng đã đăng nhập -->
                <a href="?controller=auth&action=logout" 
                   class="btn btn-outline-light btn-sm px-4 py-2 fw-semibold">
                    Đăng Xuất
                </a>
            <?php else: ?>
                <!-- Nút Đăng nhập và Đăng ký nếu người dùng chưa đăng nhập -->
                <a href="?controller=auth&action=login" 
                   class="btn btn-outline-light btn-sm px-4 py-2 fw-semibold">
                    Đăng Nhập
                </a>
                <a href="?controller=auth&action=register" 
                   class="btn btn-outline-light btn-sm px-4 py-2 fw-semibold">
                    Đăng Ký
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}

.btn-outline-light {
    border-color: #fff;
    color: #fff;
}

.btn-outline-light:hover {
    background-color: #fff;
    color: #4A90E2;
}
</style>