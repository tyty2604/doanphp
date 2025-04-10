<?php require_once ROOT . '/app/views/layouts/header.php'; ?>



<div class="container py-5">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h2 class="card-title mb-0">Thêm Sự Kiện Mới</h2>
        </div>
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">Tiêu Đề</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-heading text-primary"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="title" name="title" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">Mô Tả</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-info-circle text-info"></i>
                        </span>
                        <textarea class="form-control border-start-0" id="description" name="description" rows="4" required></textarea>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="date" class="form-label fw-semibold">Ngày</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-calendar-alt text-primary"></i>
                        </span>
                        <input type="date" class="form-control border-start-0" id="date" name="date" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="location" class="form-label fw-semibold">Vị Trí</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-map-marker-alt text-danger"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="location" name="location" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">Hình Ảnh</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-image text-secondary"></i>
                        </span>
                        <input type="file" class="form-control border-start-0" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">
                        <i class="fas fa-plus me-2"></i>Thêm
                    </button>
                    <a href="?controller=event&action=index" class="btn btn-secondary rounded-pill shadow-sm px-4 ms-2">
                        <i class="fas fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>
            </form>
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

.form-control, .form-control:focus {
    border-color: #ddd;
    box-shadow: none;
}

.input-group-text {
    background-color: #f8f9fa;
}

.form-label {
    color: #333;
}
</style>

<?php require_once ROOT . '/app/views/layouts/footer.php'; ?>