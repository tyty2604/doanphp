<?php require_once ROOT . '/app/views/layouts/header.php'; ?>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <?php require_once ROOT . '/app/views/layouts/sidebar.php'; ?>

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

        <!-- Nội dung Quản Lý Phản Hồi -->
        <div class="container-fluid py-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h2 class="card-title mb-0"><i class="fas fa-comments me-2"></i>Quản Lý Phản Hồi</h2>
                </div>
                <div class="card-body p-4">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error']; unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?= $_SESSION['success']; unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(empty($feedbacks)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-comment-slash fa-4x mb-3 text-secondary"></i>
                            <p class="fs-5 mb-0">Chưa có phản hồi nào</p>
                        </div>
                    <?php else: ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Người gửi</th>
                                    <th>Nội dung</th>
                                    <th>Thời gian</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($feedbacks as $feedback): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($feedback['username'] ?? 'Không xác định') ?></td>
                                        <td><?= htmlspecialchars($feedback['content']) ?></td>
                                        <td><?= date('d-m-Y H:i', strtotime($feedback['created_at'])) ?></td>
                                        <td>
                                            <a href="?controller=feedback&action=delete&id=<?= $feedback['id'] ?>" 
                                               class="btn btn-sm btn-danger rounded-circle" 
                                               onclick="return confirm('Bạn có chắc muốn xóa phản hồi này?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS cho Sidebar -->
<style>
#wrapper {
    overflow-x: hidden;
}

#sidebar-wrapper {
    min-height: 100vh;
    width: 250px;
    transition: margin 0.25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
    background: #343a40;
}

#sidebar-wrapper .list-group-item {
    border: none;
}

#sidebar-wrapper .list-group-item:hover {
    background: #495057 !important;
}

#page-content-wrapper {
    width: 100%;
    transition: margin 0.25s ease-out;
}

#sidebarToggle {
    margin-left: 10px;
}

/* Trạng thái đóng sidebar */
#wrapper.toggled #sidebar-wrapper {
    margin-left: -250px;
}

#wrapper.toggled #page-content-wrapper {
    margin-left: 0;
}

/* Responsive */
@media (max-width: 768px) {
    #sidebar-wrapper {
        margin-left: -250px;
    }
    #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
    }
    #page-content-wrapper {
        margin-left: 0;
    }
}

.rounded-4 {
    border-radius: 0.75rem !important;
}
.rounded-top-4 {
    border-top-left-radius: 0.75rem !important;
    border-top-right-radius: 0.75rem !important;
}
</style>

<!-- JavaScript để đóng/mở sidebar -->
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