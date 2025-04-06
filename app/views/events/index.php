<?php
require_once ROOT . '/app/views/layouts/header.php';
?>

<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4 mb-5">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5">
                <h1 class="card-title text-primary fw-bold mb-3 mb-md-0">
                    <i class="fas fa-calendar-alt me-2"></i>Danh Sách Sự Kiện
                </h1>
                
                <?php if(isset($current_role) && $current_role === 'admin'): ?>
                    <a href="?controller=event&action=add" class="btn btn-success btn-lg rounded-pill px-4 shadow-sm">
                        <i class="fas fa-plus me-2"></i>Thêm Sự Kiện
                    </a>
                <?php endif; ?>
            </div>
            
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

            <div class="bg-light p-3 rounded-4 mb-4">
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                    <span class="fw-bold text-muted me-2">Lọc theo:</span>
                    <div class="btn-group shadow-sm flex-grow-1 flex-md-grow-0">
                        <a href="?controller=event&action=filter&filter=all&page=1" 
                           class="btn btn-outline-primary <?= ($current_filter ?? 'all') === 'all' ? 'active fw-bold' : '' ?>">
                            <i class="fas fa-list me-1"></i> Tất cả
                        </a>
                        <a href="?controller=event&action=filter&filter=upcoming&page=1" 
                           class="btn btn-outline-primary <?= ($current_filter ?? '') === 'upcoming' ? 'active fw-bold' : '' ?>">
                            <i class="fas fa-calendar-alt me-1"></i> Sắp diễn ra
                        </a>
                        <a href="?controller=event&action=filter&filter=ongoing&page=1" 
                           class="btn btn-outline-primary <?= ($current_filter ?? '') === 'ongoing' ? 'active fw-bold' : '' ?>">
                            <i class="fas fa-calendar-check me-1"></i> Đang diễn ra
                        </a>
                        <a href="?controller=event&action=filter&filter=past&page=1" 
                           class="btn btn-outline-primary <?= ($current_filter ?? '') === 'past' ? 'active fw-bold' : '' ?>">
                            <i class="fas fa-calendar-times me-1"></i> Đã kết thúc
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive rounded-4 shadow-sm">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%" class="py-3">ID</th>
                            <th width="20%" class="py-3">Tiêu Đề</th>
                            <th width="25%" class="py-3">Mô Tả</th>
                            <th width="20%" class="py-3">Hình Ảnh</th>
                            <th width="15%" class="py-3">Ngày</th>
                            <th width="15%" class="py-3">Địa điểm</th>
                            <th width="10%" class="text-center py-3">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($events)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted my-4">
                                        <i class="fas fa-calendar-xmark fa-4x mb-3 text-secondary"></i>
                                        <p class="fs-5 mb-0">Không có sự kiện nào</p>
                                        <p class="small text-secondary">Vui lòng thử lại sau hoặc điều chỉnh bộ lọc</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($events as $event): ?>
                                <?php 
                                    // Thêm logic để phân loại trạng thái sự kiện
                                    $event_date = strtotime($event['date']);
                                    $today = strtotime('today');
                                    $status_badge = '';
                                    $row_class = '';
                                    
                                    if($event_date > $today) {
                                        $row_class = 'table-info'; // Sắp diễn ra
                                        $status_badge = '<span class="badge bg-info text-dark rounded-pill ms-2"><i class="fas fa-clock me-1"></i>Sắp diễn ra</span>';
                                    } elseif($event_date == $today) {
                                        $row_class = 'table-success'; // Đang diễn ra
                                        $status_badge = '<span class="badge bg-success rounded-pill ms-2"><i class="fas fa-play me-1"></i>Hôm nay</span>';
                                    } else {
                                        $row_class = ''; // Đã kết thúc
                                        $status_badge = '<span class="badge bg-secondary rounded-pill ms-2"><i class="fas fa-check me-1"></i>Đã kết thúc</span>';
                                    }
                                ?>
                                <tr class="<?= $row_class ?>">
                                    <td class="py-3"><?= htmlspecialchars($event['id']) ?></td>
                                    <td class="fw-bold py-3">
                                        <?= htmlspecialchars($event['title']) ?>
                                        <?= $status_badge ?>
                                    </td>
                                    <td class="py-3">
                                        <?php 
                                        // Hiển thị mô tả rút gọn
                                        $description = htmlspecialchars($event['description'] ?? '');
                                        echo (strlen($description) > 100) 
                                            ? nl2br(substr($description, 0, 100)) . '...' 
                                            : nl2br($description);
                                        ?>
                                    </td>
                                    <td class="py-3">
                                        <?php if (!empty($event['image'])): ?>
                                            <img src="upload/events/<?= htmlspecialchars($event['image']) ?>" 
                                                alt="Hình sự kiện" 
                                                class="img-thumbnail" 
                                                style="width: 100px; height: auto;">
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Không có ảnh</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="calendar-icon bg-light text-primary p-2 rounded me-2 text-center">
                                                <div class="small text-uppercase fw-bold"><?= date('M', strtotime($event['date'])) ?></div>
                                                <div class="fw-bold"><?= date('d', strtotime($event['date'])) ?></div>
                                            </div>
                                            <div class="small text-muted">
                                                <?= date('Y', strtotime($event['date'])) ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <span><?= htmlspecialchars($event['location']) ?></span>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="?controller=event&action=detail&id=<?= $event['id'] ?>" 
                                               class="btn btn-sm btn-primary rounded-circle shadow-sm" title="Chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if(isset($current_role) && $current_role === 'admin'): ?>
                                                <a href="?controller=event&action=edit&id=<?= $event['id'] ?>" 
                                                   class="btn btn-sm btn-warning rounded-circle shadow-sm" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="?controller=event&action=delete&id=<?= $event['id'] ?>" 
                                                   class="btn btn-sm btn-danger rounded-circle shadow-sm" 
                                                   title="Xóa"
                                                   onclick="return confirm('Bạn có chắc muốn xóa sự kiện này?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(isset($total_pages) && $total_pages > 1): ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link rounded-start" 
                               href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=1" 
                               aria-label="First">
                                <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                            </a>
                        </li>
                        <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" 
                               href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $current_page - 1 ?>" 
                               aria-label="Previous">
                                <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                            </a>
                        </li>

                        <?php
                        // Hiển thị tối đa 5 trang
                        $start_page = max(1, $current_page - 2);
                        $end_page = min($total_pages, $start_page + 4);
                        
                        if ($end_page - $start_page < 4) {
                            $start_page = max(1, $end_page - 4);
                        }
                        
                        for($i = $start_page; $i <= $end_page; $i++):
                        ?>
                            <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                <a class="page-link" 
                                   href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $i ?>">
                                   <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link" 
                               href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $current_page + 1 ?>" 
                               aria-label="Next">
                                <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                            </a>
                        </li>
                        <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link rounded-end" 
                               href="?controller=event&action=filter&filter=<?= $current_filter ?>&page=<?= $total_pages ?>" 
                               aria-label="Last">
                                <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>

            
        </div>
    </div>
</div>

<style>
.calendar-icon {
    min-width: 50px;
    border: 1px solid #ddd;
}

.rounded-4 {
    border-radius: 0.75rem !important;
}

.btn-group .btn:focus {
    box-shadow: none;
}

.table-striped > tbody > tr:nth-of-type(odd) > * {
    background-color: rgba(0, 0, 0, 0.02);
}

.table th {
    font-weight: 600;
    letter-spacing: 0.5px;
}

.badge {
    font-weight: 500;
}
</style>
                            
<?php 
require_once ROOT . '/app/views/layouts/footer.php'; 
?>