<?php
require_once ROOT . '/app/views/layouts/header.php';
?>

<h1>Sửa Sự Kiện</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Tiêu Đề</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Mô Tả</label>
        <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($event['description']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">Ngày</label>
        <input type="date" class="form-control" id="date" name="date" value="<?php echo $event['date']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Vị Trí</label>
        <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($event['location']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Hình ảnh mới (nếu có)</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>

    <?php if (!empty($event['image'])): ?>
        <div class="mb-3">
            <p>Hình ảnh hiện tại:</p>
            <img src="upload/events/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" style="max-width: 300px; height: auto;">
        </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Cập Nhật</button>
</form>

<?php require_once ROOT . '/app/views/layouts/footer.php'; ?>
