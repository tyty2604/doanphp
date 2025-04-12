<?php require_once ROOT . '/app/views/layouts/header.php'; ?>

<div class="container py-5">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h2 class="card-title mb-0"><?php echo htmlspecialchars($event['title']); ?></h2>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <?php if (!empty($event['image'])): ?>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <img src="upload/events/<?php echo htmlspecialchars($event['image']); ?>" 
                             alt="Event Image" 
                             class="img-fluid rounded-3 shadow-sm" 
                             style="width: 100%; height: 250px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                <?php else: ?>
                    <div class="col-12">
                <?php endif; ?>
                    <p class="mb-3">
                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                        <strong>Ngày:</strong> <?php echo htmlspecialchars($event['date']); ?>
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                        <strong>Vị trí:</strong> <?php echo htmlspecialchars($event['location']); ?>
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-user text-success me-2"></i>
                        <strong>Người đăng:</strong> <?php echo htmlspecialchars($event['username'] ?? 'Không xác định'); ?>
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-envelope text-info me-2"></i>
                        <strong>Email:</strong> <?php echo htmlspecialchars($event['email'] ?? 'Không xác định'); ?>
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        <strong>Mô tả:</strong>
                    </p>
                    <p class="text-muted"><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-0 text-end p-3">
            <a href="?controller=event&action=index" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Quay lại
            </a>
        </div>
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

.btn-outline-light {
    border-color: #fff;
    color: #fff;
}

.btn-outline-light:hover {
    background-color: #fff;
    color: #4A90E2;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.card-body p {
    margin-bottom: 0.5rem;
}
</style>

<?php require_once ROOT . '/app/views/layouts/footer.php'; ?>