<?php
function create_code_checkout()
{
    $code = "ISMART" . rand(1000, 2000);
    return $code;
}

// nhận số lượng order
function get_num_order()
{
    $num_order = 0;
    if (!empty($_SESSION['cart']['info']['num_order'])) {
        $num_order = $_SESSION['cart']['info']['num_order'];
    }
    return $num_order;
}

// nhận thông tin về cart order
function get_cart_order()
{
    if (!empty($_SESSION['cart'])) {
        return $_SESSION['cart']['order'];
    }
    return false;
}

// nhận thông tin cart info bao gôm số lượng order
function get_cart_info()
{
    if (!empty($_SESSION['cart'])) {
        return $_SESSION['cart']['info'];
    }
    return false;
}

// update cart
function update_cart()
{
    $orders = $_SESSION['cart']['order'];
    $num_order = 0;
    $total = 0;
    if (!empty($orders)) {
        foreach ($orders as $order) {
            $num_order += $order['qty'];
            $total += $order['sub_total'];
        }
    }
    $_SESSION['cart']['info'] = [
        'num_order' => $num_order,
        'total' => $total
    ];
    // set cookie
}

function setcookie_cart($cart_json)
{
    $cart_json = json_encode($cart_json);
    setcookie('cart_order', $cart_json, time() + 9999, '/');
    return $cart_json;
}
