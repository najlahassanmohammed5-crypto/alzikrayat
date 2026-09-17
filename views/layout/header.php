<?php
/**
 * header.php
 * الجزء المشترك اللي بيظهر فوق كل صفحة، فيهو شريط التنقل
 * وبيتغير شكلو حسب حالة تسجيل الدخول
 */
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الذكريات - Alzikrayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/alzikrayat/public/photos">Alzikrayat</a> 

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/alzikrayat/public/photos">المعرض</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/alzikrayat/public/photo/create">إضافة صورة</a>
                </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <span class="nav-link text-white">Hi <?= htmlspecialchars($_SESSION['first_name']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/alzikrayat/public/logout">تسجيل الخروج</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/alzikrayat/public/login">الرجاء تسجيل الدخول</a>
                    </li>
                <?php endif; ?>
            </ul>
            
        </div>
    </div>
</nav>

<div class="container mt-4">