<?php require_once ROOT . '/app/views/layouts/header.php'; ?>



<div class="container py-5">
    <div class="mb-5">
        

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Search Bar -->
        <div class="mb-4">
            <form method="GET" action="?controller=event&action=filter">
                <input type="hidden" name="controller" value="event">
                <input type="hidden" name="action" value="filter">
                <input type="hidden" name="filter" value="<?= htmlspecialchars($current_filter ?? 'all') ?>">
                <input type="hidden" name="page" value="1">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-light border-end-0 rounded-start-4">
                        <i class="fas fa-search text-primary"></i>
                    </span>
                    <input type="text" 
                           class="form-control border-start-0 rounded-end-4" 
                           name="search" 
                           placeholder="Tìm kiếm sự kiện theo tiêu đề..." 
                           value="<?= htmlspecialchars($search_query ?? '') ?>">
                    <button type="submit" class="btn btn-primary rounded-pill ms-2">
                        <i class="fas fa-search me-2"></i>Tìm
                    </button>
                </div>
            </form>
        </div>
            <!-- Thêm Sự Kiện Button (chỉ hiển thị cho admin) -->
        
        <div class="bg-light p-3 rounded-4 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                <span class="fw-bold text-muted me-2">Lọc theo:</span>
                <div class="btn-group shadow-sm flex-grow-1 flex-md-grow-0">
                    <a href="?controller=event&action=filter&filter=all&page=1&search=<?= urlencode($search_query ?? '') ?>" 
                       class="btn btn-outline-primary <?= ($current_filter ?? 'all') === 'all' ? 'active fw-bold' : '' ?>">
                        <i class="fas fa-list me-1"></i> Tất cả
                    </a>
                    <a href="?controller=event&action=filter&filter=upcoming&page=1&search=<?= urlencode($search_query ?? '') ?>" 
                       class="btn btn-outline-primary <?= ($current_filter ?? '') === 'upcoming' ? 'active fw-bold' : '' ?>">
                        <i class="fas fa-calendar-alt me-1"></i> Sắp diễn ra
                    </a>
                    <a href="?controller=event&action=filter&filter=ongoing&page=1&search=<?= urlencode($search_query ?? '') ?>" 
                       class="btn btn-outline-primary <?= ($current_filter ?? '') === 'ongoing' ? 'active fw-bold' : '' ?>">
                        <i class="fas fa-calendar-check me-1"></i> Đang diễn ra
                    </a>
                    <a href="?controller=event&action=filter&filter=past&page=1&search=<?= urlencode($search_query ?? '') ?>" 
                       class="btn btn-outline-primary <?= ($current_filter ?? '') === 'past' ? 'active fw-bold' : '' ?>">
                        <i class="fas fa-calendar-times me-1"></i> Đã kết thúc
                    </a>
                </div>
            </div>
        </div>
        <?php if(isset($current_role) && $current_role === 'admin'): ?>
            <div class="text-end mb-4">
                <a href="?controller=event&action=add" 
                   class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                    <i class="fas fa-plus me-2"></i>Thêm Sự Kiện
                </a>
            </div>
        <?php endif; ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if(empty($events)): ?>
                <div class="col-12 text-center py-5">
                    <div class="text-muted my-4">
                        <i class="fas fa-calendar-xmark fa-4x mb-3 text-secondary"></i>
                        <p class="fs-5 mb-0">Không có sự kiện nào</p>
                        <p class="small text-secondary">Vui lòng thử lại sau hoặc điều chỉnh bộ lọc</p>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach($events as $event): ?>
                    <?php 
                        // Logic to determine event status
                        $event_date = strtotime($event['date']);
                        $today = strtotime('today');
                        $status_badge = '';
                        
                        if($event_date > $today) {
                            $status_badge = '<span class="badge bg-info text-dark rounded-pill ms-2"><i class="fas fa-clock me-1"></i>Sắp diễn ra</span>';
                        } elseif($event_date == $today) {
                            $status_badge = '<span class="badge bg-success rounded-pill ms-2"><i class="fas fa-play me-1"></i>Hôm nay</span>';
                        } else {
                            $status_badge = '<span class="badge bg-secondary rounded-pill ms-2"><i class="fas fa-check me-1"></i>Đã kết thúc</span>';
                        }
                    ?>
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm rounded-4">
                            <div class="card-header bg-primary text-white rounded-top-4">
                                <h5 class="card-title mb-0"><?= htmlspecialchars($event['title']) ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3 mb-md-0">
                                        <?php if (!empty($event['image'])): ?>
                                            <img src="upload/events/<?= htmlspecialchars($event['image']) ?>" 
                                                 alt="Hình sự kiện" 
                                                 class="img-fluid rounded-3" 
                                                 style="width: 100%; height: 150px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" 
                                                 style="width: 100%; height: 150px;">
                                                <span class "text-muted fst-italic">Không có ảnh</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="mb-2">
                                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                                            <strong>Ngày:</strong> <?= date('Y-m-d', strtotime($event['date'])) ?>
                                        </p>
                                        <p class="mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <strong>Vị trí:</strong> <?= htmlspecialchars($event['location']) ?>
                                        </p>
                                        <p class="mb-2">
                                            <i class="fas fa-info-circle text-info me-2"></i>
                                            <?php 
                                            $description = htmlspecialchars($event['description'] ?? '');
                                            echo (strlen($description) > 50) 
                                                ? nl2br(substr($description, 0, 50)) . '...' 
                                                : nl2br($description);
                                            ?>
                                        </p>
                                        <p class="mb-0"><?= $status_badge ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0 text-end">
                                <a href="?controller=event&action=detail&id=<?= $event['id'] ?>" 
                                   class="btn btn-primary rounded-pill shadow-sm">
                                    <i class="fas fa-eye me-2"></i>Chi tiết
                                </a>
                                <?php if(isset($current_role) && $current_role === 'admin'): ?>
                                    <a href="?controller=event&action=edit&id=<?= $event['id'] ?>" 
                                       class="btn btn-warning rounded-pill shadow-sm">
                                        <i class="fas fa-edit me-2"></i>Sửa
                                    </a>
                                    <a href="?controller=event&action=delete&id=<?= $event['id'] ?>" 
                                       class="btn btn-danger rounded-pill shadow-sm" 
                                       onclick="return confirm('Bạn có chắc muốn xóa sự kiện này?')">
                                        <i class="fas fa-trash me-2"></i>Xóa
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if(isset($total_pages) && $total_pages > 1): ?>
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link rounded-start" 
                           href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=1&search=<?= urlencode($search_query ?? '') ?>" 
                           aria-label="First">
                            <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                        </a>
                    </li>
                    <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" 
                           href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $current_page - 1 ?>&search=<?= urlencode($search_query ?? '') ?>" 
                           aria-label="Previous">
                            <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                        </a>
                    </li>

                    <?php
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $start_page + 4);
                    if ($end_page - $start_page < 4) {
                        $start_page = max(1, $end_page - 4);
                    }
                    for($i = $start_page; $i <= $end_page; $i++):
                    ?>
                        <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                            <a class="page-link" 
                               href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $i ?>&search=<?= urlencode($search_query ?? '') ?>">
                               <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" 
                           href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $current_page + 1 ?>&search=<?= urlencode($search_query ?? '') ?>" 
                           aria-label="Next">
                            <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                        </a>
                    </li>
                    <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link rounded-end" 
                           href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $total_pages ?>&search=<?= urlencode($search_query ?? '') ?>" 
                           aria-label="Last">
                            <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>

<style>
.rounded-4 {
    border-radius: 0.75rem !important;
}

.rounded-top-4 {
    border-top-left-radius: 0.75rem !important;
    border-top-right-radius: 0.75rem !important;
}

.rounded-start-4 {
    border-top-left-radius: 0.75rem !important;
    border-bottom-left-radius: 0.75rem !important;
}

.rounded-end-4 {
    border-top-right-radius: 0.75rem !important;
    border-bottom-right-radius: 0.75rem !important;
}

.btn-outline-light {
    border-color: #fff;
    color: #fff;
}

.btn-outline-light:hover {
    background-color: #fff;
    color: #4A90E2;
}

.btn-group .btn:focus {
    box-shadow: none;
}

.card-header {
    padding: 1rem 1.5rem;
}

.card-footer {
    padding: 0.5rem 1.5rem;
}

.card-body p {
    margin-bottom: 0.5rem;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.badge {
    font-weight: 500;
}

.form-control, .form-control:focus {
    border-color: #ddd;
    box-shadow: none;
}

.input-group-text {
    background-color: #f8f9fa;
}
</style>

<?php 
require_once ROOT . '/app/views/layouts/footer.php'; 
?>