<?php
/**
 * Photo
 * دا موديل الصور، بيتعامل مباشرة مع جدول photos في قاعدة البيانات
 * فيهو الدوال الخاصة برفع الصورة وعرضها وحذفها
 */

class Photo extends Model
{
    /**
     * الدالة دي بتضيف صورة جديدة في قاعدة البيانات
     * بتاخد رقم المستخدم صاحب الصورة واسم الملف والعنوان والوصف
     * وبترجع true لو نجحت العملية
     * @param int $userId
     * @param string $fileName
     * @param string $title
     * @param string $description
     * @return bool
     */
    public function create($userId, $fileName, $title, $description)
    {
        $sql = "INSERT INTO photos (user_id, file_name, title, description) VALUES (:user_id, :file_name, :title, :description)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'user_id' => $userId,
            'file_name' => $fileName,
            'title' => $title,
            'description' => $description
        ]);
    }

    /**
     * الدالة دي بتجيب كل الصور موجودة في قاعدة البيانات
     * مع اسم صاحب كل صورة، عشان نعرضها في الصفحة الرئيسية أو الجاليري
     * الصور بترجع من الأحدث للأقدم
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT photos.*, users.first_name, users.last_name 
                FROM photos 
                JOIN users ON photos.user_id = users.id 
                ORDER BY photos.date_time DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * الدالة دي بتجيب صورة واحدة بس بالـ id بتاعها
     * مع اسم صاحبها، بنستخدمها وقت نعرض تفاصيل الصورة كاملة
     * @param int $id
     * @return array|false
     */
    public function findById($id)
    {
        $sql = "SELECT photos.*, users.first_name, users.last_name 
                FROM photos 
                JOIN users ON photos.user_id = users.id 
                WHERE photos.id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * الدالة دي بتجيب كل الصور بتاعة مستخدم معين بس
     * بنستخدمها في صفحة البروفايل بتاع المستخدم
     * @param int $userId
     * @return array
     */
    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM photos WHERE user_id = :user_id ORDER BY date_time DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * الدالة دي بتمسح صورة من قاعدة البيانات
     * بس بتتأكد الأول إن صاحب الصورة هو نفسو صاحب الحساب الداخل
     * عشان محدا يقدر يمسح صورة شخص تاني
     * @param int $photoId
     * @param int $userId
     * @return bool
     */
    public function delete($photoId, $userId)
    {
        $sql = "DELETE FROM photos WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $photoId,
            'user_id' => $userId
        ]);
    }
}