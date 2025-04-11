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

        <!-- Nội dung chính -->
        <div class="container-fluid py-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h1 class="card-title text-primary fw-bold">
                            <i class="fas fa-users me-2"></i>Quản Lý Người Dùng
                        </h1>
                        <a href="?controller=user&action=add" class="btn btn-success btn-lg rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Thêm Người Dùng
                        </a>
                    </div>

                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?= $_SESSION['success']; unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error']; unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive rounded-4 shadow-sm">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%" class="py-3">ID</th>
                                    <th width="20%" class="py-3">Tên Người Dùng</th>
                                    <th width="25%" class="py-3">Email</th>
                                    <th width="15%" class="py-3">Vai Trò</th>
                                    <th width="15%" class="py-3 text-center">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($users)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted my-4">
                                                <i class="fas fa-users-slash fa-4x mb-3 text-secondary"></i>
                                                <p class="fs-5 mb-0">Không có người dùng nào</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($users as $user): ?>
                                        <tr>
                                            <td class="py-3"><?= htmlspecialchars($user['id']) ?></td>
                                            <td class="py-3"><?= htmlspecialchars($user['username']) ?></td>
                                            <td class="py-3"><?= htmlspecialchars($user['email']) ?></td>
                                            <td class="py-3">
                                                <span class="badge bg-<?= $user['role'] === 'admin' ? 'primary' : 'secondary' ?> rounded-pill">
                                                    <?= $user['role'] === 'admin' ? 'Admin' : 'User' ?>
                                                </span>
                                            </td>
                                            <td class="py-3 text-center">
                                                <a href="?controller=user&action=edit&id=<?= $user['id'] ?>" 
                                                   class="btn btn-sm btn-warning rounded-circle" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="?controller=user&action=delete&id=<?= $user['id'] ?>" 
                                                   class="btn btn-sm btn-danger rounded-circle" 
                                                   title="Xóa"
                                                   onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS cho Sidebar (giữ nguyên từ Dashboard) -->
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