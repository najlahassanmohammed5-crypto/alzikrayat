<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="p-4 mb-4 bg-light rounded-3 text-center">
    <h1 class="display-6">الذكريات</h1>
    <p class="lead">منصة لمشاركة الصور والتعليق عليها بين المستخدمين، تتيح لك الاحتفاظ بأجمل اللحظات ومشاركتها مع الآخرين.</p>
    <p class="text-muted">
        <?php $photoCount = count($photos); ?>
        عدد الصور المشتركة حتى الآن: <strong><?= $photoCount ?></strong>
    </p>
</div>

<div class="mb-4">
    <h4>من نحن</h4>
    
    <p>
        تتيح منصة "الذكريات" للمستخدمين رفع صورهم ومشاركتها مع الآخرين والتعليق عليها بسهولة.
        تبقى كل صورة يرفعها المستخدم ملكاً خاصاً له، ولا يستطيع أي مستخدم آخر حذفها أو التحكم فيها،
        حفاظاً على خصوصية الذكريات وأمانها.
    </p>
    <p>
        يهدف التطبيق إلى توفير بيئة بسيطة وآمنة لمشاركة اللحظات المميزة بين المستخدمين المسجلين.
    </p>
</div>

<h2 class="mb-4">معرض الصور</h2>

<div class="mb-3 text-center">
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setGrid(3)">3 أعمدة</button>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setGrid(4)">4 أعمدة</button>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setGrid(12)">قائمة</button>
    </div>
</div>

<div class="row" id="photoGrid">

    <?php if (empty($photos)): ?>
        <p>لا توجد صور حتى الآن.</p>
    <?php else: ?>
        <?php foreach ($photos as $photo): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="/alzikrayat/public/images/uploads/<?= htmlspecialchars($photo['file_name']) ?>"
                         class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($photo['title']) ?></h5>
                        <p class="card-text text-muted">
                            بواسطة <?= htmlspecialchars($photo['first_name'] . ' ' . $photo['last_name']) ?>
                        </p>
                        <a href="/alzikrayat/public/photo/<?= $photo['id'] ?>" class="btn btn-outline-primary btn-sm">
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
function setGrid(columns) {
    const cols = document.querySelectorAll('#photoGrid > div');
    const colClass = columns === 12 ? 'col-12' : `col-md-${12/columns}`;
    cols.forEach(col => {
        col.className = col.className.replace(/col-md-\d+/, colClass);
    });
}
</script>


<?php require __DIR__ . '/../layout/footer.php'; ?>