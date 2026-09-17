<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="row">
    <div class="col-md-7">
        <img src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
             class="img-fluid rounded mb-3">
    </div>

    <div class="col-md-5">
        <h2><?= htmlspecialchars($photo['title']) ?></h2>
        <p class="text-muted">
            بواسطة <?= htmlspecialchars($photo['first_name'] . ' ' . $photo['last_name']) ?>
            &middot; <?= htmlspecialchars($photo['date_time']) ?>
        </p>

        <?php if (!empty($photo['description'])): ?>
            <p><?= htmlspecialchars($photo['description']) ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $photo['user_id']): ?>
            <a href="/alzikrayat/public/photo/<?= $photo['id'] ?>/delete"
               class="btn btn-outline-danger btn-sm"
               onclick="return confirm('هل أنت متأكد من حذف هذه الصورة؟')">
                حذف الصورة
            </a>
        <?php endif; ?>

        <hr>

        <h5>التعليقات</h5>

        <?php if (empty($comments)): ?>
            <p class="text-muted">لا توجد تعليقات حتى الآن.</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <div class="border-bottom pb-2 mb-2">
                    <strong><?= htmlspecialchars($comment['first_name'] . ' ' . $comment['last_name']) ?></strong>
                    <p class="mb-0"><?= htmlspecialchars($comment['comment']) ?></p>
                    <small class="text-muted"><?= htmlspecialchars($comment['date_time']) ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="/alzikrayat/public/comment/<?= $photo['id'] ?>/store" method="POST" class="mt-3">
                <div class="mb-2">
                    <textarea name="comment" class="form-control" rows="2" required placeholder="اكتب تعليقك هنا"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">إضافة تعليق</button>
            </form>
        <?php else: ?>
            <p class="mt-3"><a href="/alzikrayat/public/login">يرجى تسجيل الدخول</a> لإضافة تعليق.</p>
        <?php endif; ?>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
