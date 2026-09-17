<?php
/**
 * CommentController
 * دا الكنترولر المسؤول عن إضافة تعليق على صورة معينة
 */

class CommentController extends Controller
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment();
    }

    /**
     * الدالة دي بتستقبل تعليق جديد من فورم في صفحة تفاصيل الصورة
     * ما بتشتغل إلا لو المستخدم مسجل دخول
     * بعد ما تحفظ التعليق بترجع المستخدم لنفس صفحة الصورة عشان يشوف التعليق فوراً
     * @param int $photoId
     * @return void
     */
    public function store($photoId)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location:/alzikrayat/public/login');
            exit;
        }

        $commentText = trim($_POST['comment'] ?? '');

        if (!empty($commentText)) {
            $this->commentModel->create($photoId, $_SESSION['user_id'], $commentText);
        }

        header('Location:/alzikrayat/public/photo/' . $photoId);
        exit;
    }
}