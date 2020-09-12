<?php
/**
 * Đây là nơi cập nhật session
 * 
 * Khi trình duyệt bắt đầu load web
 */

// update cookie to session
if (empty($_SESSION['cart']['order']) && !empty($_COOKIE['cart_order'])) {
    // conver json to array
    $cart_cookie = json_decode($_COOKIE['cart_order'], true);
    $_SESSION['cart']['order'] = $cart_cookie;
    update_cart();
}

//Triệu gọi đến file xử lý thông qua request
$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller() . 'Controller.php';

if (file_exists($request_path)) {
    require $request_path;
} else {
    echo "Không tìm thấy:$request_path ";
}

$action_name = get_action() . 'Action';

call_function(array('construct', $action_name));
