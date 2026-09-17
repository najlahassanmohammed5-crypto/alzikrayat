<?php
/**
 * web.php
 * هنا بنسجل كل الروابط بتاعة المشروع ونربط كل رابط بالكنترولر والدالة المسؤولة عنو
 */

$router = new Router();

$router->add('GET', '/photos', ['PhotoController', 'index']);
$router->add('GET', '/photo/create', ['PhotoController', 'create']);
$router->add('GET', '/photo/{id}', ['PhotoController', 'show']);
$router->add('POST', '/photo/store', ['PhotoController', 'store']);
$router->add('GET', '/photo/{id}/delete', ['PhotoController', 'delete']);

$router->add('POST', '/comment/{photoId}/store', ['CommentController', 'store']);

$router->add('GET', '/login', ['AuthController', 'showLogin']);
$router->add('POST', '/login', ['AuthController', 'login']);
$router->add('GET', '/register', ['AuthController', 'showRegister']);
$router->add('POST', '/register', ['AuthController', 'register']);
$router->add('GET', '/logout', ['AuthController', 'logout']);



