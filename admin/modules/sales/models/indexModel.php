<?php

function get_customers_seach($seach)
{
    global $conn;
    $seach = mysqli_escape_string($conn, $seach);
    $seach = !empty($seach) ? "AND `fullname` LIKE '%{$seach}%'" : NULL;
    $sql = " SELECT * FROM `users` LEFT JOIN `user_roles` ON `users`.`id`=`user_roles`.`user_id` LEFT JOIN `roles` ON `user_roles`.`role_id`=`roles`.`id` WHERE `name`='Customer' {$seach}";
    $result = db_fetch_array($sql);
    return $result;
};
// Nhận thông tin seach
function get_orders_seach($seach)
{
    global $conn;
    $seach = mysqli_escape_string($conn, $seach);
    $seach = !empty($seach) ? "WHERE `fullname` LIKE '%{$seach}%' OR `code` LIKE '%{$seach}%'" : NULL;
    $sql = " SELECT * FROM `orders` {$seach}";
    $result = db_fetch_array($sql);
    return $result;
};
// tính tổng số khách hàng theo seach
function count_custormer($seach)
{
    $seach = !empty($seach) ? "AND WHERE `fullname` LIKE '%{$seach}%'" : NULL;
    $sql = "SELECT COUNT(`users`.`id`) as `total` FROM `users` LEFT JOIN `user_roles` ON `users`.`id`=`user_roles`.`user_id` LEFT JOIN `roles` ON `user_roles`.`role_id`=`roles`.`id` WHERE `name`='Customer' {$seach}";
    $result = db_fetch_row($sql);
    return $result['total'];
}

// lấy các thông tin bảng khách hàng theo seach và pagging orderby
function get_custormers($start, $num_per_page, $seach, $sort)
{
    $seach = !empty($seach) ? "WHERE `fullname` LIKE '%{$seach}%' OR `code` LIKE '%{$seach}%'" : NULL;
    $sort = !empty($sort) ? "ORDER BY `fullname` {$sort} " : NULL;
    // Không hiển thị admin
    $sql = "SELECT * FROM `users` LEFT JOIN `user_roles` ON `users`.`id`=`user_roles`.`user_id` LEFT JOIN `roles` ON `user_roles`.`role_id`=`roles`.`id` WHERE `name`='Customer' {$seach} {$sort} LIMIT {$start},{$num_per_page}";
    $result = db_fetch_array($sql);
    return $result;
};

// tính tổng số khách hàng theo seach
function count_order()
{
    $seach = !empty($seach) ? "WHERE `fullname` LIKE '%{$seach}%' OR `code` LIKE '%{$seach}%'" : NULL;
    $sql = "SELECT COUNT(`id`) AS `total` FROM `orders` {$seach}";
    $result = db_fetch_row($sql);
    return $result['total'];
}

// lấy các thông tin bảng khách hàng theo seach và pagging orderby

function get_orders($start, $num_per_page, $seach, $sort)
{
    $seach = !empty($seach) ? "AND WHERE `fullname` LIKE '%{$seach}%'" : NULL;
    $sort = !empty($sort) ? "ORDER BY `created_at` {$sort} " : NULL;
    $sql = "SELECT * FROM `orders` {$seach} {$sort} LIMIT {$start},{$num_per_page} ";
    $result = db_fetch_array($sql);
    return $result;
};

// lấy thông tin đơn hàng theo order coder

function get_order_by_code($code)
{
    $sql = "SELECT * FROM `orders`";
    $result = db_fetch_row($sql);
    return $result;
}

function update_order_by_code($code, $status)
{
    db_update('orders',['status' => $status], "`code`='{$code}'");
}

// Nhận thông tin chi tiết đơn hàng
function get_order($start, $num_per_page)
{
    $code_order = $_SESSION['code_order'];
    $where = "WHERE `code_order`='{$code_order}'";
    $sql = "SELECT `tbl_thumb_product`.`thumb_product`,`tbl_list_product`.*,`tbl_order`.`qty`,`tbl_order`.`code_order` FROM `tbl_order` LEFT JOIN `tbl_list_product` ON `tbl_order`.`product_id`=`tbl_list_product`.`product_id` LEFT JOIN `tbl_thumb_product` ON `tbl_list_product`.`product_id`=`tbl_thumb_product`.`product_id` {$where} GROUP BY `product_id` LIMIT $start,$num_per_page";
    $result = db_fetch_array($sql);
    return $result;
};

// Nhận tổng số lượng sản phẩm và tổng phần tiền

function get_total_order_by_code($code_order)
{
    $sql = "SELECT `tbl_order`.`qty`,`tbl_list_product`.`price_new` FROM `tbl_order` LEFT JOIN `tbl_list_product` ON `tbl_order`.`product_id`=`tbl_list_product`.`product_id` WHERE `code_order`='{$code_order}'";
    $result = db_fetch_array($sql);
    $total_price = 0;
    $num_order = 0;
    foreach ($result as $item) {
        $total_price += $item['qty'] * $item['price_new'];
        $num_order += $item['qty'];
    }

    // add array $result
    $result['total_price'] = $total_price;
    $result['num_order'] = $num_order;
    return $result;
}
