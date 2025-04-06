<div class="container mt-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded shadow-sm">
        <!-- Tiêu đề với icon -->
        <h1 class="mb-0 d-flex align-items-center text-primary">
            <i class="fas fa-calendar-alt me-2"></i>
            <span class="fw-bold">Lịch Sự Kiện</span>
        </h1>

        <!-- Phần người dùng -->
        <div class="d-flex align-items-center gap-3">
            <?php if(isset($_SESSION['user_id'])): ?>
                <!-- Chào mừng người dùng -->
                <span class="badge bg-success text-white px-3 py-2 rounded-pill">
                    Xin chào, 
                    <?php 
                    if($_SESSION['role'] === 'admin') {
                        echo 'Admin';
                    } else {
                        echo htmlspecialchars($_SESSION['username'] ?? 'Người dùng');
                    }
                    ?>!
                </span>
                <!-- Nút đăng xuất -->
                <a href="?controller=auth&action=logout" 
                   class="btn btn-outline-danger btn-sm px-3 py-2 d-flex align-items-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> 
                    Đăng Xuất
                </a>
            <?php else: ?>
                <!-- Nút đăng nhập và đăng ký -->
                <a href="?controller=auth&action=login" 
                   class="btn btn-outline-primary btn-sm px-4 py-2 fw-semibold">
                    Đăng Nhập
                </a>
                <a href="?controller=auth&action=register" 
                   class="btn btn-primary btn-sm px-4 py-2 fw-semibold">
                    Đăng Ký
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>