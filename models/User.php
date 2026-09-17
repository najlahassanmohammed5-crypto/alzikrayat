<?php
/**
 * User
 * دا موديل المستخدمين، بيتعامل مباشرة مع جدول users في قاعدة البيانات
 * فيهو الدوال الخاصة بالتسجيل وتسجيل الدخول والبحث عن مستخدم
 */

class User extends Model
{
    /**
     * الدالة دي بتسجل مستخدم جديد في قاعدة البيانات
     * بتاخد البيانات وبتشفر الباسورد قبل ما تحفظو، الباسورد الأصلي ما بيتحفظ خالص
     * وبترجع true لو نجح التسجيل
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function create($firstName, $lastName, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }

    /**
     * الدالة دي بتدور على مستخدم بالإيميل بتاعو
     * بنستخدمها وقت تسجيل الدخول عشان نجيب بيانات المستخدم ونتاكد من الباسورد
     * لو ما لقت حاجة بترجع false
     * @param string $email
     * @return array|false
     */
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * الدالة دي بتدور على مستخدم بالـ id بتاعو
     * بنستخدمها وقت نعرض اسم صاحب الصورة أو صاحب التعليق
     * @param int $id
     * @return array|false
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * الدالة دي بتتأكد هل الإيميل داخل مستخدم من قبل ولا لأ
     * بنستخدمها وقت التسجيل عشان نمنع تكرار نفس الإيميل
     * @param string $email
     * @return bool
     */
    public function emailExists($email)
    {
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch() !== false;
    }
}