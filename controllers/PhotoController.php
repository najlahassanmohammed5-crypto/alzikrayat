<?php
/**
 * PhotoController
 * دا الكنترولر المسؤول عن كل حاجة متعلقة بالصور
 * عرض الجاليري، عرض تفاصيل صورة، رفع صورة جديدة، وحذف صورة
 */

class PhotoController extends Controller
{
    private $photoModel;
    private $commentModel;

    public function __construct()
    {
        $this->photoModel = new Photo();
        $this->commentModel = new Comment();
    }

    /**
     * الدالة دي بتعرض كل الصور في صفحة الجاليري الرئيسية
     * @return void
     */
    public function index()
    {
        $photos = $this->photoModel->getAll();
        $this->render('photos/index', ['photos' => $photos]);
    }

    /**
     * الدالة دي بتعرض تفاصيل صورة واحدة مع كل تعليقاتها
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $photo = $this->photoModel->findById($id);

        if (!$photo) {
            http_response_code(404);
            echo "الصورة  غير موجودة";
            return;
        }

        $comments = $this->commentModel->getByPhotoId($id);

        $this->render('photos/show', [
            'photo' => $photo,
            'comments' => $comments
        ]);
    }

    /**
     * الدالة دي بتعرض فورم رفع صورة جديدة
     * ما بتشتغل إلا لو المستخدم مسجل دخول
     * @return void
     */
    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location:/alzikrayat/public/login');
            exit;
        }

        $this->render('photos/create');
    }

    /**
     * الدالة دي بتستقبل بيانات رفع الصورة
     * بتتحقق من نوع الملف وحجمو، وبتحفظو في مجلد uploads
     * وبتحفظ بياناتو في قاعدة البيانات مربوطة بالمستخدم الداخل
     * @return void
     */
    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location:/alzikrayat/public/login');
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $errors = [];

        if (empty($title)) {
            $errors[] = "عنوان الصورة مطلوب";
        }

        if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "يرجى اختيار صورة";
        } else {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = mime_content_type($_FILES['photo']['tmp_name']);

            if (!in_array($fileType, $allowedTypes)) {
                $errors[] = "نوع الملف غير مسموح، لازم يكون صورة jpg أو png أو gif";
            }

            if ($_FILES['photo']['size'] > 5 * 1024 * 1024) {
                $errors[] = "حجم الصورة كبير جداً، الحد الأقصى 5 ميجا";
            }
        }

        if (!empty($errors)) {
            $this->render('photos/create', ['errors' => $errors]);
            return;
        }

        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('photo_') . '.' . $extension;
        $destination = __DIR__ . '/../public/images/uploads/' . $fileName;

        move_uploaded_file($_FILES['photo']['tmp_name'], $destination);

        $this->photoModel->create($_SESSION['user_id'], $fileName, $title, $description);

        header('Location:/alzikrayat/public/photos');
        exit;
    }
           

    public function delete($id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }

        $this->photoModel->delete($id,$_SESSION['user_id']);

        header('Location: /alzikrayat/public/photos');
        
        exit;
    }
}

