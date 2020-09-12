<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    load_view('index');
}

function listCustomerAction()
{

    // chia làm 2 chức năng riêng biệtbh
    if (!empty($_GET['box_seach'])) {
        $seach = $_GET['box_seach'];
        $data = NULL;
        $customers = get_customers_seach($seach);
        foreach ($customers as $value) {
            $data .= "<li><a href=''>{$value['fullname']}</a></li>";
        }
        echo $data;
    }
    if (isset($_GET['seach'])) {
        /*
        * thông tin phía client
        * page: thông tin trang hiện tại
        * sort: sắp xếp
        * seach :tìm kiếm
        */
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $sort = $_GET['sort'] ?? NULL;
        $seach = $_GET['seach'] ?? NULL;

        $total = count_custormer($seach);
        $info = info_paginate($total, $page);
        $start = $info['start'];
        $num_page = $info['num_page'];
        $num_per_page = $info['num_per_page'];
        $customers = get_custormers($start, $num_per_page, $seach, $sort);
        $customer = NULL;
        $temp = 0;
        foreach ($customers as $value) {
            $temp++;
            $customer .= "<tr>";
            $customer .= "<td><span class='tbody-text'> {$temp} </h3></span></td>";
            $customer .= "<td>";
            $customer .= "<div class='tbody-thumb'>";
            $customer .= "<img src=' {$value['thumbnail']} '>";
            $customer .= "</div>";
            $customer .= "</td>";
            $customer .= "<td>";
            $customer .= "<div class='tb-title fl-left'><a href=''> {$value['fullname']} </a></div>";
            $customer .= "<ul class='list-operation fl-right'>";
            $customer .= "<li><a href='' title='Sửa' class='edit'><i class='fas fa-edit'></i></a>";
            $customer .= "<a href='' title='Chat' class='chat'><i class='fas fa-sms'></i></a></li></ul>";
            $customer .= "</td>";
            $customer .= "<td><span class='tbody-text'> {$value['username']} </span></td>";
            $customer .= "<td><span class='tbody-text'> {$value['email']} </span></td>";
            $customer .= "<td><span class='tbody-text'> {$value['address']} </span></td>";
            $customer .= "<td><span class='tbody-text'> {$value['phone']} </span></td>";
            $customer .= "<td><span class='tbody-text'> {$value['name']} </span></td>";
            $customer .= "</tr>";
        }
        $paginate = paginate($num_page, $page);
        $list_data_product = array(
            'send' => $customer,
            'paginate' => $paginate,
        );
        echo json_encode($list_data_product);
    }
}
function listOrderAction()
{
    load_view('list_order');
}

#dùng ajax để lấy dữ liệu

function getListOrderAction()
{
    //    chia làm 2 chức năng riêng biệt
    if (!empty($_GET["box_seach"])) {
        $seach = $_GET['box_seach'];
        $data = NULL;
        $list_data = get_orders_seach($seach);
        foreach ($list_data as $value) {
            $data .= "<li><a href=''>{$value['fullname']}</a></li>";
        }
        echo $data;
    }
    if (isset($_GET['seach'])) {
        /*
        * thông tin phía client
        * page: thông tin trang hiện tại
        * sort: sắp xếp
        * seach :tìm kiếm
        */
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $sort = $_GET['sort'] ?? NULL;
        $seach = $_GET['seach'] ?? NULL;
        $total = count_order();
        $info = info_paginate($total, $page);
        $start = $info['start'];
        $num_page = $info['num_page'];
        $num_per_page = $info['num_per_page'];
        $orders = get_orders($start, $num_per_page, $seach, $sort);
        $order = "";
        $temp = 0;
        foreach ($orders as $value) {
            $product = json_decode($value['products'], true);
            $total = currency_format($product['info']['total']);
            $temp++;
            $order .= "<tr>";
            $order .= "<td><span class='tbody-text'> {$temp} </h3></span>";
            $order .= "<td><span class='tbody-text'> {$value['code']} </h3></span>";
            $order .= "<td><div class='tb-title fl-left'><a href=''> {$value['fullname']} </a></div>";
            $order .= "<ul class='list-operation fl-right'>";
            $order .= "<li><a href='" . base_url("?mod=sales&action=detailsOrder&code={$value['code']}") . "' title='Chi tiết đơn hàng' class='edit detail_order'><i class='fas fa-info-circle'></i></a></li></ul></td>";
            $order .= "<td><span class='tbody-text'> {$value['fullname']} </span></td>";
            $order .= "<td><span class='tbody-text'> {$total} </span></td>";
            $order .= "<td><span class='tbody-text'> {$value['status']} </span></td>";
            $order .= "<td><span class='tbody-text'> {$value['created_at']} </span></td></tr>";
        }
        $pagging = paginate($num_page, $page);
        $data_order = array(
            'send' => $order,
            'pagging' => $pagging,
        );
        echo json_encode($data_order);
    }
};
function detailsOrderAction()
{
    if (!empty($_GET['code'])) {
        $code = $_GET['code'];
        # sesstion show list order product ajax
        $_SESSION['code'] = $code;
        $order = get_order_by_code($code);
        $products = json_decode($order['products'], true)['info'];
        //    kiểm tra nếu mã code không hợp lệ sẽ chuyển sang trang khác
        if (count($order) == 0)
            redirect_to("?mod=sales&action=listOrder");
        //    thông tin đơn hàng chuyển qua view
        $data = array(
            'num_order' => $products['num_order'],
            'total' => $products['total'],
            'fullname' => $order['fullname'],
            'code' => $order['code'],
            'address' => $order['address'],
            'payment_method' => $order['payment_method'],
            'status' => $order['status'],
            'note' => $order['note']
        );
        // update form
        if (!empty($_POST['btn_update'])) {
            $status = $_POST['status'];
            // cập nhật trạng thái giỏ hàng
            update_order_by_code($code, $status);
            redirect_to("?mod=sales&action=detailsOrder&code={$code}");
        }
        load_view('details_order', $data);
    } else
        redirect_to("?mod=sales&action=listOrder");
}

function detailsOrderProductAction()
{
    /*
    *    thông tin phía client
    *    page: thông tin trang hiện tại
    *    sort: sắp xếp
    *    seach :tìm kiếm
    */
    $code = $_SESSION['code'] ?? '';
    // get code thông qua session đã lưu khi vào chi tiết
    $order = get_order_by_code($code);
    // chuyển đổi json thành mảng
    $products = json_decode($order['products'], true)['order'];
    $product = "";
    $temp = 0;
    foreach ($products as $value) {
        $price = currency_format($value['price']);
        $sub_total = currency_format($value['sub_total']);
        $temp++;
        $product .= "<tr>";
        $product .= "<td class='thead-text'> {$temp} </td>";
        $product .= "<td class='thead-text'>";
        $product .= "<div class='thumb'><img src=' {$value['thumbnail']}'></div></td>";
        $product .= "<td class='thead-text'> {$value['title']} </td>";
        $product .= "<td class='thead-text'> {$price} </td>";
        $product .= "<td class='thead-text'> {$value['qty']} </td>";
        $product .= "<td class='thead-text'> {$sub_total} </td>";
        $product .= "</tr>";
    }
    $data_product = [
        'send' => $product,
    ];
    echo json_encode($data_product);
}
