<?php require_once ROOT . '/app/views/layouts/header.php'; ?>

<h1><?php echo htmlspecialchars($event['title']); ?></h1>
<p><strong>Ngày:</strong> <?php echo $event['date']; ?></p>
<p><strong>Vị trí:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
<p><strong>Mô tả:</strong></p>
<p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>

<?php if (!empty($event['image'])): ?>
    <div>
        <img src="upload/events/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" style="max-width: 400px;">
    </div>
<?php endif; ?>

<a href="?controller=event&action=index" class="btn btn-secondary mt-3">Quay lại</a>

<?php require_once ROOT . '/app/views/layouts/footer.php'; ?>
