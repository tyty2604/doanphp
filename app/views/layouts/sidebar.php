<div class="bg-dark text-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom">
        <i class="fas fa-tachometer-alt me-2"></i>Quản lý
    </div>
    <div class="list-group list-group-flush">
        <?php if ($current_role === 'admin'): ?>
            <a href="?controller=event&action=dashboard" 
               class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-tachometer-alt me-2"></i>Bảng điều khiển
            </a>
            <a href="?controller=user&action=index" 
               class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-users me-2"></i>Quản Lý Người Dùng
            </a>
            <a href="?controller=feedback&action=index" 
               class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-comments me-2"></i>Quản Lý Phản Hồi
            </a>
        <?php else: ?>
            <a href="?controller=user&action=profile" 
               class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-user me-2"></i>Hồ sơ cá nhân
            </a>
            <a href="?controller=event&action=index" 
               class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-calendar-alt me-2"></i>Quản lý sự kiện
            </a>
        <?php endif; ?>
        <a href="?controller=event&action=add" 
           class="list-group-item list-group-item-action bg-dark text-white py-3">
            <i class="fas fa-plus me-2"></i>Thêm Sự Kiện
        </a>
        <a href="?controller=auth&action=logout" 
           class="list-group-item list-group-item-action bg-dark text-white py-3">
            <i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất
        </a>
    </div>
</div>