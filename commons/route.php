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
$router->get('error-page', [App\Controllers\Client\homeController::class, "errorPage"]);

$router->get('search', [App\Controllers\Client\homeController::class, "seacrh"]);
$router->get('menu/{id_ct}', [App\Controllers\Client\homeController::class, "menu"]);

$router->post('add-cart', [App\Controllers\Client\CartController::class, "addCart"]);
$router->post('update-quantity-product-cart', [App\Controllers\Client\CartController::class, "updateQuantityProductCart"]);


$router->post('add-order', [App\Controllers\Client\cartController::class, "addOrder"]);
$router->get('order/success', [App\Controllers\Client\cartController::class, "success"]);
$router->get('order/errors', [App\Controllers\Client\cartController::class, "errors"]);
$router->get('list-order', [App\Controllers\Client\cartController::class, "listOrder"]);
$router->get('detail-order', [App\Controllers\Client\cartController::class, "detailOrder"]);
$router->get('delete-cart-product/{id}', [App\Controllers\Client\cartController::class, "deleteCartProduct"]);
$router->get('list-cart', [App\Controllers\Client\cartController::class, "index"]);
$router->get('delete-cart', [App\Controllers\Client\cartController::class, 'delete']);
$router->get('order', [App\Controllers\Client\cartController::class, 'order']);
$router->get('detail/{id}', [App\Controllers\Client\ProductController::class, 'detailProduct']);
$router->get('top', [App\Controllers\Client\ProductController::class, 'listTopProduct']);

$router->post('add-comment/{id}', [App\Controllers\Client\ProductController::class, "detailProduct"]);
$router->get('form-login', [App\Controllers\Client\LoginController::class, "formLogin"]);
$router->post('login', [App\Controllers\Client\LoginController::class, "login"]);
$router->get('logout', [App\Controllers\Client\LoginController::class, "logout"]);
$router->get('form-register', [App\Controllers\Client\LoginController::class, "formRegister"]);
$router->post('register', [App\Controllers\Client\LoginController::class, "register"]);

$router->get('post/{pageNumber}', [App\Controllers\Client\PostController::class, "list"]);
$router->get('post/detail/{id}', [App\Controllers\Client\PostController::class, "detail"]);
$router->get('discount', [App\Controllers\Client\DiscountController::class, "list"]);


$router->get('inbox', [App\Controllers\Client\LoginController::class, "inbox"]);
$router->post('add-box', [App\Controllers\Client\LoginController::class, "addBox"]);
$router->post('send', [App\Controllers\Client\LoginController::class, "send"]);

$router->post('list-cm/{id}', [App\Controllers\Client\ProductController::class, "listCM"]);


$router->filter('admin', function() use ($router) {

    if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
        // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
        header('Location: ' . BASE_URL . 'admin/login');
        exit; // Sử dụng exit thay vì die để đảm bảo tính nhất quán
    }
});
$router->get('admin/login', [App\Controllers\Admin\AuthenController::class, "login"]);
$router->post('admin/check-login', [App\Controllers\Admin\AuthenController::class, "checkLogin"]);
$router->group(['before' => 'admin'], function($router) {
// Sử dụng group() để nhóm các route cho phía admin và tự động thêm tiền tố "/admin/" cho các route bên trong nhóm này
    $router->group(['prefix' => 'admin'], function ($router) {
        $router->get('/', [App\Controllers\Admin\DashboardController::class, "index"]);
        $router->get('list-conversation', [App\Controllers\Admin\AuthenController::class, "listInbox"]);
        $router->post('darkMode', [App\Controllers\Admin\DashboardController::class, "darkMode"]);
        $router->get('/list-product/{pageNumber}', [App\Controllers\Admin\ProductController::class, "list"]);
        $router->get('/form-add', [App\Controllers\Admin\ProductController::class, "formAdd"]);
        $router->post('/post-product', [App\Controllers\Admin\ProductController::class, "addProduct"]);
        $router->get('/delete-product/{id}', [App\Controllers\Admin\ProductController::class, "deleteProduct"]);
        $router->get('/list-discount/{pageNumber}', [App\Controllers\Admin\DiscountController::class, "list"]);
        $router->get('/settings', [App\Controllers\Admin\SettingController::class, "form"]);
        $router->post('/settings/update', [App\Controllers\Admin\SettingController::class, "formUpdate"]);

        $router->get('/discount/form-add', [App\Controllers\Admin\DiscountController::class, "formAdd"]);
        $router->post('/discount/post', [App\Controllers\Admin\DiscountController::class, "post"]);
        $router->get('/logout', [App\Controllers\Admin\AuthenController::class, "logout"]);

        $router->get('/post/list/{pageNumber}', [App\Controllers\Admin\PostController::class, "list"]);
        $router->get('/post/detail/{id}', [App\Controllers\Admin\PostController::class, "detail"]);
        $router->get('/post/form-add', [App\Controllers\Admin\PostController::class, "formAdd"]);
        $router->post('/post/add', [App\Controllers\Admin\PostController::class, "add"]);

        $router->get('/post/form-update/{id}', [App\Controllers\Admin\PostController::class, "formUpdate"]);

        $router->get('/chat/{id}', [App\Controllers\Admin\AuthenController::class, "chat"]);
        $router->post('/send', [App\Controllers\Admin\AuthenController::class, "send"]);


        $router->get('/category', [App\Controllers\Admin\CategoryController::class, "list"]);
        $router->get('/category/add', [App\Controllers\Admin\CategoryController::class, "formAdd"]);

        $router->get('/order', [App\Controllers\Admin\OrderController::class, "list"]);

        $router->get('/comment', [App\Controllers\Admin\CommentController::class, "list"]);
        $router->get('/users', [App\Controllers\Admin\AuthenController::class, "list"]);


    });
});


// NB. Bạn có thể cache kết quả trả về từ $router->getData() để không cần phải tạo lại các route mỗi lần yêu cầu - tăng tốc độ đáng kể
// Tạo một Dispatcher để xử lý các route và phản hồi cho yêu cầu
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

// Sử dụng dispatcher để dispatch yêu cầu và nhận kết quả trả về từ route được thực thi
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// In ra giá trị được trả về từ hàm route đã được thực thi
echo $response;

?>
