<?php

// Sử dụng namespace Phroute\Phroute\RouteCollector để định nghĩa các route
use Phroute\Phroute\RouteCollector;

// Kiểm tra xem biến $_GET['url'] đã được thiết lập chưa, nếu chưa thì mặc định là "/"
$url = isset($_GET['url']) ? $_GET['url'] : "/";

// Tạo một đối tượng RouteCollector để quản lý các route
$router = new RouteCollector();

// Định nghĩa các route cho phía client

// Trang chính
$router->get('/', [App\Controllers\Client\HomeController::class, "index"]);

// Trang lỗi
$router->get('error-page', [App\Controllers\Client\HomeController::class, "errorPage"]);

// Tìm kiếm
$router->get('search', [App\Controllers\Client\HomeController::class, "search"]);

// Menu
$router->get('menu/{id_ct}', [App\Controllers\Client\HomeController::class, "menu"]);

// Quản lý giỏ hàng
$router->post('add-cart', [App\Controllers\Client\CartController::class, "addCart"]);
$router->post('update-quantity-product-cart', [App\Controllers\Client\CartController::class, "updateQuantityProductCart"]);
$router->post('add-order', [App\Controllers\Client\CartController::class, "addOrder"]);
$router->get('order/success', [App\Controllers\Client\CartController::class, "success"]);
$router->get('order/errors', [App\Controllers\Client\CartController::class, "errors"]);
$router->get('list-order', [App\Controllers\Client\CartController::class, "listOrder"]);
$router->get('detail-order', [App\Controllers\Client\CartController::class, "detailOrder"]);
$router->get('delete-cart-product/{id}', [App\Controllers\Client\CartController::class, "deleteCartProduct"]);
$router->get('list-cart', [App\Controllers\Client\CartController::class, "index"]);
$router->get('delete-cart', [App\Controllers\Client\CartController::class, 'delete']);
$router->get('order', [App\Controllers\Client\CartController::class, 'order']);

// Chi tiết sản phẩm và sản phẩm nổi bật
$router->get('detail/{id}', [App\Controllers\Client\ProductController::class, 'detailProduct']);
$router->get('top', [App\Controllers\Client\ProductController::class, 'listTopProduct']);

// Bình luận
$router->post('add-comment/{id}', [App\Controllers\Client\ProductController::class, "detailProduct"]);

// Đăng nhập, đăng ký, đăng xuất, cập nhật tài khoản
$router->get('form-login', [App\Controllers\Client\LoginController::class, "formLogin"]);
$router->post('login', [App\Controllers\Client\LoginController::class, "login"]);
$router->get('logout', [App\Controllers\Client\LoginController::class, "logout"]);
$router->get('form-update', [App\Controllers\Client\LoginController::class, "formUpdate"]);
$router->post('update', [App\Controllers\Client\LoginController::class, "update"]);
$router->get('form-update/pass', [App\Controllers\Client\LoginController::class, "formPass"]);
$router->post('update/pass', [App\Controllers\Client\LoginController::class, "updatePass"]);

$router->get('form-register', [App\Controllers\Client\LoginController::class, "formRegister"]);
$router->post('register', [App\Controllers\Client\LoginController::class, "register"]);

// Quản lý bài viết
$router->get('post/{pageNumber}', [App\Controllers\Client\PostController::class, "list"]);
$router->get('post/detail/{id}', [App\Controllers\Client\PostController::class, "detail"]);

// Quản lý khuyến mãi
$router->get('discount', [App\Controllers\Client\DiscountController::class, "list"]);

// Hộp thư đến và gửi tin nhắn
$router->get('inbox', [App\Controllers\Client\LoginController::class, "inbox"]);
$router->post('add-box', [App\Controllers\Client\LoginController::class, "addBox"]);
$router->post('send', [App\Controllers\Client\LoginController::class, "send"]);

// Quản lý bình luận cho sản phẩm
$router->post('list-cm/{id}', [App\Controllers\Client\ProductController::class, "listCM"]);

// Chi tiết đơn hàng
$router->get('detail-order/{id}', [App\Controllers\Client\CartController::class, "detail"]);

// Hủy đơn hàng
$router->post('huy', [App\Controllers\Client\CartController::class, "huy"]);

$router->post("vnpay", [App\Controllers\Client\PaymentController::class, "vnpay"]);

$router->filter('admin', function () use ($router) {

        if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
                // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
                header('Location: ' . BASE_URL . 'admin/login');
                exit; // Sử dụng exit thay vì die để đảm bảo tính nhất quán
        }
});
$router->get('admin/login', [App\Controllers\Admin\AuthenController::class, "login"]);
$router->post('admin/check-login', [App\Controllers\Admin\AuthenController::class, "checkLogin"]);

$router->group(['before' => 'admin'], function ($router) {
        $router->group(['prefix' => 'admin'], function ($router) {
                // Định nghĩa các route cho phía admin

                // Trang dashboard
                $router->get('/', [App\Controllers\Admin\DashboardController::class, "index"]);

                // Quản lý hộp thư
                $router->get('list-conversation', [App\Controllers\Admin\AuthenController::class, "listInbox"]);

                // Chế độ tối
                $router->post('darkMode', [App\Controllers\Admin\DashboardController::class, "darkMode"]);

                // Quản lý sản phẩm
                $router->get('/product/thong-ke', [App\Controllers\Admin\ProductController::class, "thongKe"]);
                $router->get('/list-product/{pageNumber}', [App\Controllers\Admin\ProductController::class, "list"]);
                $router->post('/list-product-category', [App\Controllers\Admin\ProductController::class, "listCategory"]);
                $router->get('/form-add', [App\Controllers\Admin\ProductController::class, "formAdd"]);
                $router->post('/post-product', [App\Controllers\Admin\ProductController::class, "addProduct"]);
                $router->get('/product/form-update/{id}', [App\Controllers\Admin\ProductController::class, "formUpdate"]);
                $router->post('/product/update', [App\Controllers\Admin\ProductController::class, "updateProduct"]);
                $router->get('/delete-product/{id}', [App\Controllers\Admin\ProductController::class, "deleteProduct"]);

                // Quản lý khuyến mãi
                $router->get('/list-discount/{pageNumber}', [App\Controllers\Admin\DiscountController::class, "list"]);
                $router->get('/discount/form-add', [App\Controllers\Admin\DiscountController::class, "formAdd"]);
                $router->post('/discount/post', [App\Controllers\Admin\DiscountController::class, "post"]);
                $router->get('/discount/form-update/{id}', [App\Controllers\Admin\DiscountController::class, "formUpdate"]);
                $router->post('/discount/update', [App\Controllers\Admin\DiscountController::class, "update"]);

                // Cài đặt
                $router->get('/settings', [App\Controllers\Admin\SettingController::class, "form"]);
                $router->post('/settings/update', [App\Controllers\Admin\SettingController::class, "formUpdate"]);

                // Quản lý bài viết
                $router->get('/post/list/{pageNumber}', [App\Controllers\Admin\PostController::class, "list"]);
                $router->get('/post/detail/{id}', [App\Controllers\Admin\PostController::class, "detail"]);
                $router->get('/post/form-add', [App\Controllers\Admin\PostController::class, "formAdd"]);
                $router->post('/post/add', [App\Controllers\Admin\PostController::class, "add"]);
                $router->get('/post/form-update/{id}', [App\Controllers\Admin\PostController::class, "formUpdate"]);
                $router->post('/post/update', [App\Controllers\Admin\PostController::class, "update"]);
                $router->get('/post/delete/{id}', [App\Controllers\Admin\PostController::class, "delete"]);
                // Trò chuyện
                $router->get('/chat/{id}', [App\Controllers\Admin\AuthenController::class, "chat"]);
                $router->post('/send', [App\Controllers\Admin\AuthenController::class, "send"]);

                // Quản lý danh mục
                $router->get('/category', [App\Controllers\Admin\CategoryController::class, "list"]);
                $router->get('/category/add', [App\Controllers\Admin\CategoryController::class, "formAdd"]);
                $router->post('/post-category', [App\Controllers\Admin\CategoryController::class, "postCategory"]);
                $router->get('/category/update/{id}', [App\Controllers\Admin\CategoryController::class, "formUpdate"]);
                $router->post('/category/update-category', [App\Controllers\Admin\CategoryController::class, "updateCategory"]);
                $router->get('/category/delete/{id}', [App\Controllers\Admin\CategoryController::class, "deleteCategory"]);

                // Quản lý đơn hàng
                $router->get('/order/status/{status}', [App\Controllers\Admin\OrderController::class, "status"]);
                $router->get('/order/thong-ke', [App\Controllers\Admin\OrderController::class, "thongKe"]);
                $router->get('/order/{pageNumber}', [App\Controllers\Admin\OrderController::class, "list"]);
                $router->get('/order/detail/{id}', [App\Controllers\Admin\OrderController::class, "detail"]);
                $router->get('/order/detail/update/{id}', [App\Controllers\Admin\OrderController::class, "updatedetail"]);
                $router->post('/order/post', [App\Controllers\Admin\OrderController::class, "postDetail"]);


                // Quản lý bình luận
                $router->get('/comment/{pageNumber}', [App\Controllers\Admin\CommentController::class, "list"]);
                $router->get('/comment/feedback/{id}', [App\Controllers\Admin\CommentController::class, "listFeedback"]);
                $router->post('/comment/feedback/insert', [App\Controllers\Admin\CommentController::class, "insertFeedback"]);

                // Quản lý tài khoản người dùng
                $router->get('/user/thong-ke', [App\Controllers\Admin\AuthenController::class, "thongKe"]);
                $router->get('/users/{pageNumber}', [App\Controllers\Admin\AuthenController::class, "list"]);
                $router->get('/users/lock/{id}', [App\Controllers\Admin\AuthenController::class, "lockTK"]);
                $router->get('/users/mo/{id}', [App\Controllers\Admin\AuthenController::class, "moTK"]);

                // Quản lý biến thể sản phẩm
                $router->post('/variant/delete', [App\Controllers\Admin\ProductController::class, "deleteVariant"]);
                $router->get('/variant/{id}', [App\Controllers\Admin\ProductController::class, "listVariant"]);
                $router->get('/variant-add/{id}', [App\Controllers\Admin\ProductController::class, "formAddVR"]);
                $router->post('/post-variant', [App\Controllers\Admin\ProductController::class, "addVR"]);
                $router->get('/variant-update/{id}', [App\Controllers\Admin\ProductController::class, "formUpdateVR"]);
                $router->post('/update-variant', [App\Controllers\Admin\ProductController::class, "updateVR"]);
        });
});


// NB. Bạn có thể cache kết quả trả về từ $router->getData() để không cần phải tạo lại các route mỗi lần yêu cầu - tăng tốc độ đáng kể
// Tạo một Dispatcher để xử lý các route và phản hồi cho yêu cầu
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

// Sử dụng dispatcher để dispatch yêu cầu và nhận kết quả trả về từ route được thực thi
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// In ra giá trị được trả về từ hàm route đã được thực thi
echo $response;
