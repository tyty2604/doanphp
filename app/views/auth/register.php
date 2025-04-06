<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="register-container shadow-lg p-5 rounded-4 bg-light" style="max-width: 450px; width: 100%; border: 1px solid #e0e0e0;">
        <!-- Tiêu đề -->
        <h1 class="text-center mb-5 fw-bold" style="color: #4361ee; font-size: 2rem;">
            <i"></i>Đăng Ký
        </h1>

        <!-- Thông báo lỗi -->
        <?php if(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                <?php echo htmlspecialchars($error); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form đăng ký -->
        <form method="POST">
            <div class="mb-4">
                <label for="username" class="form-label fw-semibold text-dark">Tên Đăng Nhập</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-user text-muted"></i></span>
                    <input type="text" 
                           class="form-control border-start-0 shadow-sm" 
                           id="username" 
                           name="username" 
                           placeholder="Nhập tên đăng nhập" 
                           required 
                           style="border-radius: 0 8px 8px 0; transition: all 0.3s ease;">
                </div>
            </div>

            <div class="mb-5">
                <label for="password" class="form-label fw-semibold text-dark">Mật Khẩu</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" 
                           class="form-control border-start-0 shadow-sm" 
                           id="password" 
                           name="password" 
                           placeholder="Nhập mật khẩu" 
                           required 
                           style="border-radius: 0 8px 8px 0; transition: all 0.3s ease;">
                </div>
            </div>

            <button type="submit" 
                    class="btn btn-success w-100 py-3 fw-semibold text-uppercase" 
                    style="border-radius: 10px; background: linear-gradient(90deg, #4361ee,  #4361ee); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                <i class="fas fa-user-check me-2"></i>Đăng Ký
            </button>
        </form>

        <!-- Liên kết bổ sung -->
        <div class="text-center mt-4">
            <small class="text-muted">Đã có tài khoản? 
                <a href="?controller=auth&action=login" 
                   class="fw-semibold" 
                   style="color:  #4361ee; text-decoration: none; transition: color 0.3s ease;">Đăng nhập ngay</a>
            </small>
        </div>
    </div>
</div>