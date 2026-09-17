<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <h2 class="mb-4">إنشاء حساب جديد</h2>

        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/alzikrayat/public/register" method="POST" novalidate>
            <div class="mb-3">
                <label class="form-label">الاسم الأول</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الاسم الأخير</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required minlength="6">
            </div>

            <button type="submit" class="btn btn-success w-100">إنشاء الحساب</button>
        </form>

        <p class="mt-3 text-center">
            هل لديك حساب ؟ <a href="/alzikrayat/public/login">تسجيل دخول</a>
        </p>
    </div>
</div>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const firstName = document.querySelector('[name="first_name"]').value.trim();
    const namePattern = /^[a-zA-Z\u0600-\u06FF\s]+$/;

    if (!namePattern.test(firstName)) {
        e.preventDefault();
        alert('يجب ان يحتوي الاسم على حروف فقط');
    }
});
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>