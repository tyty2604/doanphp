<?php
require_once ROOT . '/app/views/layouts/header.php';
?>

<h1>Thêm Sự Kiện Mới</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Tiêu Đề</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Mô Tả</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Ngày</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Vị Trí</label>
        <input type="text" class="form-control" id="location" name="location" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Hình Ảnh</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>


<?php require_once ROOT . '/app/views/layouts/footer.php'; ?>