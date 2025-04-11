<?php require_once ROOT . '/app/views/layouts/header.php'; ?>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom">
            <i class="fas fa-tachometer-alt me-2"></i>Admin Panel
        </div>
        <div class="list-group list-group-flush">
            <a href="?controller=event&action=dashboard" 
               class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-tachometer-alt me-2"></i>Bảng điều khiển
            </a>
            <a href="?controller=user&action=index" 
                class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-users me-2"></i>Quản Lý Người Dùng
            </a>
            <a href="?controller=event&action=index" 
               class="list-group-item list-group-item-action bg-dark text-white py-3">
                <i class="fas fa-calendar-alt me-2"></i>Danh Sách Sự Kiện
            </a>
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

    <!-- Nội dung chính -->
    <div id="page-content-wrapper">
        <!-- Nút đóng/mở sidebar -->
        <nav class="navbar navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </nav>

        <!-- Form sửa người dùng -->
        <div class="container-fluid py-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="card-title text-primary fw-bold mb-5">
                        <i class="fas fa-user-edit me-2"></i>Sửa Người Dùng
                    </h1>

                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error']; unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="?controller=user&action=edit&id=<?= $user['id'] ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Tên Người Dùng</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Mật Khẩu Mới (Để trống nếu không đổi)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label fw-bold">Vai Trò</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-2"></i>Lưu
                            </button>
                            <a href="?controller=user&action=index" class="btn btn-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i>Quay Lại
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS cho Sidebar -->
<style>
#wrapper { overflow-x: hidden; }
#sidebar-wrapper { min-height: 100vh; width: 250px; transition: margin 0.25s ease-out; }
#sidebar-wrapper .sidebar-heading { background: #343a40; }
#sidebar-wrapper .list-group-item { border: none; }
#sidebar-wrapper .list-group-item:hover { background: #495057 !important; }
#page-content-wrapper { width: 100%; transition: margin 0.25s ease-out; }
#sidebarToggle { margin-left: 10px; }
#wrapper.toggled #sidebar-wrapper { margin-left: -250px; }
#wrapper.toggled #page-content-wrapper { margin-left: 0; }
@media (max-width: 768px) {
    #sidebar-wrapper { margin-left: -250px; }
    #wrapper.toggled #sidebar-wrapper { margin-left: 0; }
    #page-content-wrapper { margin-left: 0; }
}
</style>

<!-- JavaScript cho Sidebar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const wrapper = document.getElementById('wrapper');
    sidebarToggle.addEventListener('click', function() {
        wrapper.classList.toggle('toggled');
    });
});
</script>

<?php require_once ROOT . '/app/views/layouts/footer.php'; ?>