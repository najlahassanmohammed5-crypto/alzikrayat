<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <h2 class="mb-4">تسجيل الدخول</h2>

        <?php if (isset($lastLogin) && $lastLogin): ?>
            <div class="alert alert-info">
                آخر دخول من هذا الجهاز كان في: <?= htmlspecialchars($lastLogin) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/alzikrayat/public/login" method="POST" novalidate>
            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required minlength="6">
            </div>

            <button type="submit" class="btn btn-primary w-100">دخول</button>
        </form>

        <p class="mt-3 text-center">
            لاتملك حساب؟ <a href="/alzikrayat/public/register">سجل هنا</a>
        </p>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>