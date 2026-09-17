<?php
/**
 * Controller
 * دا كلاس أساسي كل الكنترولرز بتاعتنا بترث منو
 * غرضو يوفر لينا دالة واحدة نحمل بيها الفيوهات بدل ما نكرر نفس الكلام في كل كنترولر
 */

abstract class Controller
{
    /**
     * الدالة دي بتحمل ملف الفيو المطلوب وبتوديله البيانات جاهزة كمتغيرات
     * ماشة نديها اسم الفيو زي photos/index وبيانات نحتاجها تظهر فيهو
     * وهي بترجع الصفحة معمولة ready بدون ما نكرر كود
     * @param string $view
     * @param array $data
     * @return void
     */
    protected function render($view, $data = [])
    {
        extract($data);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("View not found: " . $view);
        }
    }
}