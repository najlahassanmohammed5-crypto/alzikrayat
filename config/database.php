<?php
/**
 * Database.php
 * 
 * الغرض: إنشاء اتصال واحد بقاعدة البيانات باستخدام PDO
 *  (Models) للتعامل مع البيانات
 * 
 * نمط التصميم: Singleton - يعني الاتصال يتكرر إنشاءه مرة واحدة بس
 * لكل الطلب (Request)، بدل ما نفتح اتصال جديد كل مرة
 */

class Database
{
    // بيانات الاتصال بقاعدة البيانات
    private static $host = "localhost";
    private static $dbname = "alzikrayat_db";
    private static $username = "root";
    private static $password = ""; // XAMPP الافتراضي: كلمة سر فاضية

    // متغير ثابت يخزن الاتصال الوحيد (Singleton)
    private static $connection = null;

    /**
     * دالة تعيد اتصال PDO بقاعدة البيانات
     * لو الاتصال موجود بالفعل، بترجعه بدون ما تنشئ اتصال جديد
     *
     * @return PDO كائن الاتصال بقاعدة البيانات
     */
    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4";
                
                self::$connection = new PDO($dsn, self::$username, self::$password);
                
                // تفعيل عرض الأخطاء بشكل واضح أثناء التطوير
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}