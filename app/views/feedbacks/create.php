<?php require_once ROOT . '/app/views/layouts/header.php'; ?>

<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h2 class="card-title mb-0"><i class="fas fa-comment me-2"></i>Gửi Phản Hồi</h2>
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

            <form method="POST" action="?controller=feedback&action=create">
                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Nội dung phản hồi</label>
                    <textarea class="form-control rounded-3" 
                              id="content" 
                              name="content" 
                              rows="5" 
                              placeholder="Nhập phản hồi của bạn..." 
                              required></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-paper-plane me-2"></i>Gửi
                    </button>
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
.form-control:focus {
    border-color: #4A90E2;
    box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
}
</style>

<?php require_once ROOT . '/app/views/layouts/footer.php'; ?>