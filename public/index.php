<?php
/**
 * index.php
 * دي نقطة الدخول الوحيدة للمشروع كامل (Front Controller)
 * كل طلب داخل للموقع بيمر من هنا الأول
 */

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../config',
        __DIR__ . '/../core',
        __DIR__ . '/../controllers',
        __DIR__ . '/../models'
    ];

    foreach ($paths as $path) {
        $file = $path . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$basePath = '/alzikrayat/public';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

$_SERVER['REQUEST_URI'] = $requestUri ?: '/';

require_once __DIR__ . '/../routes/web.php';

$router->dispatch();