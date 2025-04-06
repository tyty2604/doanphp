<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-container shadow-lg p-4 rounded-3 bg-white" style="max-width: 400px; width: 100%;">
        <!-- Tiêu đề -->
        <h1 class="text-center mb-4 fw-bold text-primary">Đăng Nhập</h1>

        <!-- Thông báo lỗi -->
        <?php if(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form đăng nhập -->
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Tên Đăng Nhập</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Mật Khẩu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                <i class="fas fa-sign-in-alt me-2"></i>Đăng Nhập
            </button>
        </form>

        <!-- Liên kết bổ sung -->
        <div class="text-center mt-3">
            <small class="text-muted">Chưa có tài khoản? 
                <a href="?controller=auth&action=register" class="text-primary fw-semibold">Đăng ký ngay</a>
            </small>
        </div>
    </div>
</div>