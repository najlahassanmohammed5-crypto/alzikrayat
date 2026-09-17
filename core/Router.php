<?php
/**
 * Router
 *
 * محرك توجيه يدوي بسيط يربط بين طريقة الطلب (HTTP Method) ورابط URL
 * وبين الـ Controller المناسب. يدعم أجزاء ديناميكية في الرابط مثل {id}
 * باستخدام Regular Expressions، بدون أي مكتبة توجيه خارجية.
 */

class Router
{
    private $routes = [];

    /**
     * تسجيل route جديد في القائمة
     *
     * @param string $method طريقة الطلب (GET, POST, ...)
     * @param string $path نمط الرابط، مثال: "/photo/{id}"
     * @param array $action مصفوفة فيها [اسم الكلاس, اسم الدالة]
     * @return void
     */
    public function add($method, $path, $action)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'action' => $action
        ];
    }

    /**
     * مطابقة الطلب الحالي مع الـ routes المسجلة
     * وتوجيهه تلقائياً لدالة الـ Controller المناسبة
     *
     * @return void
     */
    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '([^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches);

                [$controllerName, $methodName] = $route['action'];

                $controller = new $controllerName();
                call_user_func_array([$controller, $methodName], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "404 - Page Not Found";
    }
}