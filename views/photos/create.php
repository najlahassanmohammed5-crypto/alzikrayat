<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">إضافة صورة جديدة</h2>

        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/alzikrayat/public/photo/store" method="POST" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label class="form-label">عنوان الصورة</label>
                <input type="text" name="title" class="form-control" required maxlength="200">
            </div>

            <div class="mb-3">
                <label class="form-label">وصف الصورة (اختياري)</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">اختار صورة</label>
                <input type="file" name="photo" class="form-control" accept="image/jpeg, image/png, image/gif" required>
            </div>

            <button type="submit" class="btn btn-primary">رفع الصورة</button>
        </form>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const fileInput = document.querySelector('[name="photo"]');
    const file = fileInput.files[0];

    if (file && file.size > 5 * 1024 * 1024) {
        e.preventDefault();
        alert('حجم الصورة كبير جداً، الحد الأقصى 5 ميجا');
    }
});
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
