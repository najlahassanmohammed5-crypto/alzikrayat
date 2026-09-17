<?php
/**
 * Comment
 * دا موديل التعليقات، بيتعامل مباشرة مع جدول comments في قاعدة البيانات
 * فيهو الدوال الخاصة بإضافة تعليق وجلب كل تعليقات صورة معينة
 */

class Comment extends Model
{
    /**
     * الدالة دي بتضيف تعليق جديد على صورة معينة
     * بتاخد رقم الصورة ورقم المستخدم اللي كاتب التعليق ونص التعليق
     * وبترجع true لو نجحت العملية
     * @param int $photoId
     * @param int $userId
     * @param string $commentText
     * @return bool
     */
    public function create($photoId, $userId, $commentText)
    {
        $sql = "INSERT INTO comments (photo_id, user_id, comment) VALUES (:photo_id, :user_id, :comment)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'photo_id' => $photoId,
            'user_id' => $userId,
            'comment' => $commentText
        ]);
    }

    /**
     * الدالة دي بتجيب كل التعليقات بتاعة صورة معينة
     * مع اسم صاحب كل تعليق، بترجع من الأقدم للأحدث عشان تتعرض بترتيب طبيعي
     * @param int $photoId
     * @return array
     */
    public function getByPhotoId($photoId)
    {
        $sql = "SELECT comments.*, users.first_name, users.last_name 
                FROM comments 
                JOIN users ON comments.user_id = users.id 
                WHERE comments.photo_id = :photo_id 
                ORDER BY comments.date_time ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['photo_id' => $photoId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}