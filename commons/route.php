<?php

// Sử dụng namespace Phroute\Phroute\RouteCollector để định nghĩa các route
use Phroute\Phroute\RouteCollector;

// Kiểm tra xem biến $_GET['url'] đã được thiết lập chưa, nếu chưa thì mặc định là "/"
$url = isset($_GET['url']) ? $_GET['url'] : "/";

// Tạo một đối tượng RouteCollector để quản lý các route
$router = new RouteCollector();

// Khu vực cần quan tâm -----------

// Định nghĩa các route cho phía client
$router->get('/', [App\Controllers\Client\homeController::class, "index"]);
$router->get('search', [App\Controllers\Client\homeController::class, "seacrh"]);
$router->get('menu/{id_ct}', [App\Controllers\Client\homeController::class, "menu"]);

$router->post('add-cart', [App\Controllers\Client\cartController::class, "addCart"]);
$router->get('list-cart', [App\Controllers\Client\cartController::class, "index"]);
$router->get('delete-cart', [App\Controllers\Client\cartController::class, 'delete']);
$router->get('order', [App\Controllers\Client\cartController::class, 'order']);
$router->get('detail/{id}', [App\Controllers\Client\ProductController::class, 'detailProduct']);
$router->post('add-comment/{id}', [App\Controllers\Client\ProductController::class, "detailProduct"]);
$router->get('form-login', [App\Controllers\Client\LoginController::class, "formLogin"]);
$router->post('login', [App\Controllers\Client\LoginController::class, "login"]);
$router->get('logout', [App\Controllers\Client\LoginController::class, "logout"]);

// Sử dụng group() để nhóm các route cho phía admin và tự động thêm tiền tố "/admin/" cho các route bên trong nhóm này
$router->group(['prefix' => 'admin'], function($router) {
    $router->get('/', [App\Controllers\Admin\DashboardController::class, "index"]);
    $router->get('/list-product', [App\Controllers\Admin\ProductController::class, "list"]);
    $router->get('/form-add', [App\Controllers\Admin\ProductController::class, "formAdd"]);
    $router->post('/post-product', [App\Controllers\Admin\ProductController::class, "addProduct"]);
    $router->get('/delete-product/{id}', [App\Controllers\Admin\ProductController::class, "deleteProduct"]);

    // Các đường dẫn khác bên trong nhóm "admin" sẽ tự động có tiền tố "/admin/"
});

// NB. Bạn có thể cache kết quả trả về từ $router->getData() để không cần phải tạo lại các route mỗi lần yêu cầu - tăng tốc độ đáng kể
// Tạo một Dispatcher để xử lý các route và phản hồi cho yêu cầu
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

// Sử dụng dispatcher để dispatch yêu cầu và nhận kết quả trả về từ route được thực thi
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// In ra giá trị được trả về từ hàm route đã được thực thi
echo $response;

?>
