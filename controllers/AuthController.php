<?php
/**
 * AuthController
 * دا الكنترولر المسؤول عن كل حاجة متعلقة بالمستخدم
 * التسجيل، تسجيل الدخول، تسجيل الخروج، وكوكي آخر دخول
 */

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * الدالة دي بتعرض فورم تسجيل الدخول
     * وقبل ما تعرضو بتجيب قيمة كوكي آخر دخول لو موجودة عشان تعرضها زي ما طلب الملف
     * @return void
     */
    public function showLogin()
    {
        $lastLogin = isset($_COOKIE['last_login']) ? $_COOKIE['last_login'] : null;
        $this->render('auth/login', ['lastLogin' => $lastLogin]);
    }

    /**
     * الدالة دي بتعرض فورم إنشاء حساب جديد
     * @return void
     */
    public function showRegister()
    {
        $this->render('auth/register');
    }

    /**
     * الدالة دي بتستقبل بيانات التسجيل من الفورم
     * بتتحقق من صحة البيانات على مستوى السيرفر قبل ما تحفظها
     * ولو الإيميل مسجل من قبل بترجع رسالة خطأ بدل ما تكمل
     * @return void
     */
    public function register()
    {
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $errors = [];

        if (empty($firstName) || !preg_match('/^[a-zA-Z\x{0600}-\x{06FF}\s]+$/u', $firstName)) {
            $errors[] = "الاسم الأول لازم يكون حروف بس";
        }

        if (empty($lastName) || !preg_match('/^[a-zA-Z\x{0600}-\x{06FF}\s]+$/u', $lastName)) {
            $errors[] = "الاسم الأخير لازم يكون حروف بس";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "الإيميل غير صحيح";
        }

        if (strlen($password) < 6) {
            $errors[] = "الباسورد لازم يكون 6 حروف على الأقل";
        }

        if (empty($errors) && $this->userModel->emailExists($email)) {
            $errors[] = "الإيميل دا مسجل مسبقاً";
        }

        if (!empty($errors)) {
            $this->render('auth/register', ['errors' => $errors]);
            return;
        }

        $this->userModel->create($firstName, $lastName, $email, $password);

        header('Location: /alzikrayat/public/login');
        exit;
    }

    /**
     * الدالة دي بتستقبل بيانات تسجيل الدخول
     * بتتأكد من الإيميل والباسورد، ولو صح بتفتح جلسة وتحفظ كوكي آخر دخول
     * @return void
     */
    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $this->render('auth/login', ['error' => "الإيميل أو الباسورد غلط"]);
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];

        setcookie('last_login', date('Y-m-d H:i:s'), time() + (7 * 24 * 60 * 60), '/');

        header('Location:/alzikrayat/public/photos');
        exit;
    }

    /**
     * الدالة دي بتقفل جلسة المستخدم الحالي
     * الكوكي بتاعة آخر دخول ما بتتمسح، لأنها مرتبطة بالمتصفح مش بالجلسة
     * @return void
     */
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /alzikrayat/public/login');
        exit;
    }
}