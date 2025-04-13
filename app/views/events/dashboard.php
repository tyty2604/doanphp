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

        <!-- Nội dung Dashboard -->
        <div class="container-fluid py-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">
                    <h1 class="card-title text-primary fw-bold mb-5">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        <?= $current_role === 'admin' ? 'Dashboard' : 'Tổng quan sự kiện' ?>
                    </h1>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                        <!-- Tổng số sự kiện -->
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 bg-primary text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Tổng Sự Kiện</h5>
                                    <p class="display-4 fw-bold"><?= $total_events ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Sự kiện sắp diễn ra -->
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 bg-info text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Sắp Diễn Ra</h5>
                                    <p class="display-4 fw-bold"><?= $upcoming_events ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Sự kiện đang diễn ra -->
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 bg-success text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Đang Diễn Ra</h5>
                                    <p class="display-4 fw-bold"><?= $ongoing_events ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- Sự kiện đã kết thúc -->
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 bg-secondary text-white">
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">Đã Kết Thúc</h5>
                                    <p class="display-4 fw-bold"><?= $past_events ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Phản hồi chưa đọc (chỉ cho admin) -->
                            <?php if ($current_role === 'admin'): ?>
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-sm rounded-3 bg-warning text-white">
                                        <div class="card-body text-center">
                                            <h5 class="card-title fw-bold">Phản Hồi Chưa Đọc</h5>
                                            <p class="display-4 fw-bold"><?= $unread_feedbacks ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <!-- Nút quay lại danh sách sự kiện -->
                    <div class="mt-5 text-center">
                        <a href="?controller=event&action=index" class="btn btn-primary btn-lg rounded-pill px-4">
                            <i class="fas fa-arrow-left me-2"></i>
                            <?= $current_role === 'admin' ? 'Quay lại Danh sách Sự kiện' : 'Quản lý sự kiện' ?>
                        </a>
                    </div>

                    <div class="row mt-5">
                        <div class="col">
                            <div class="card border-0 shadow-lg rounded-4">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold mb-4">
                                        <?= $current_role === 'admin' ? 'Các sự kiện gần đây' : 'Sự kiện của bạn' ?>
                                    </h5>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tiêu Đề</th>
                                                <th>Ngày</th>
                                                <th>Địa Điểm</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_events as $event): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($event['title']) ?></td>
                                                    <td><?= date('d-m-Y', strtotime($event['date'])) ?></td>
                                                    <td><?= htmlspecialchars($event['location']) ?></td>
                                                    <td>
                                                        <a href="?controller=event&action=detail&id=<?= $event['id'] ?>" 
                                                           class="btn btn-sm btn-primary rounded-circle">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <?php if ($current_role === 'admin' || $event['user_id'] == $current_user_id): ?>
                                                            <a href="?controller=event&action=edit&id=<?= $event['id'] ?>" 
                                                               class="btn btn-sm btn-warning rounded-circle">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="?controller=event&action=delete&id=<?= $event['id'] ?>" 
                                                               class="btn btn-sm btn-danger rounded-circle" 
                                                               onclick="return confirm('Bạn có chắc muốn xóa sự kiện này?')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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