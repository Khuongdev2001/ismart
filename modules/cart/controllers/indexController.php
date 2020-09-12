<?php
function construct()
{
    load_model('index');
}

function addCartAction()
{
    /**
     * 
     * qty là số lượng sản phẩm input
     * 
     * id là id sản phẩm
     * 
     * session['cart']['order'][$id]
     * 
     * action này kết hợp giữa add và update
     * 
     */
    if (isset($_POST['add']) || isset($_POST['update'])) {
        $qty = intval($_POST['qty']);
        $id = intval($_POST['id']);
        if (isset($_SESSION['cart']['order'][$id])) {
            $qty_old = $_SESSION['cart']['order'][$id]['qty'];

            /**
             * Nếu request update.update giá trị lun
             * 
             * Nếu request add. nếu id add tồn tại sẽ lấy số lượng cũ cộng thêm mới
             * 
             */

            if (isset($_POST['add'])) {
                $qty += $qty_old;
            }
        }
        $product = get_product_by_id($id);
        $_SESSION['cart']['order'][$id] = [
            'id' => $id,
            'qty' => $qty,
            'title' => $product['title'],
            'code' => $product['code'],
            'price' => $product['price'],
            'thumbnail' => $product['thumbnail'],
            'sub_total' => $qty * $product['price']
        ];
        update_cart();
        // nếu qty là 0 thì xóa luôn
        $qty = $_SESSION['cart']['order'][$id]['qty'];
        if ($qty == 0) {
            unset($_SESSION['cart']['order'][$id]);
            $cart_order = $_SESSION['cart']['order'];
            echo json_encode(['status' => 'reload']);
            setcookie_cart($cart_order);
            // dừng chương trình luôn
            die();
        }
        // conver array to json
        $cart_orders = $_SESSION['cart']['order'];
        $cart_order = $cart_orders[$id];
        /**
         * chuyển đổi mảng sản json dể lưu cookie  
         * 
         * set cookie và hàm này đã có sẵn json_endcode rồi
         */
        setcookie_cart($cart_orders);
        $cart_info = $_SESSION['cart']['info'];
        echo json_encode(['id' => $id, 'qty' => $cart_order['qty'], 'total' => $cart_info['total'], 'num_order' => $cart_info['num_order'], 'sub_total' => $cart_order['sub_total'], 'status' => 'normal']);
    }
}

function showCartAction()
{
    $data = [];
    if (!empty($_SESSION['cart'])) {
        $carts = get_cart_order();
        $info = get_cart_info();
        $data = [
            'carts' => $carts,
            'info' => $info
        ];
    }
    load_view('index', $data);
}
function deleteAction()
{
    $id = intval($_GET['id']);
    if (empty($id)) {
        unset($_SESSION['cart']);
        setcookie('cart_order', '', time() - 3600, '/');
        redirect_to("?mod=home");
        die();
    }
    // tìm key xóa theo yêu cầu
    if (array_key_exists($id, $_SESSION['cart']['order'])) {
        unset($_SESSION['cart']['order'][$id]);
        $cart_order = $_SESSION['cart']['order'];
        // update cart
        update_cart();
        setcookie_cart($cart_order);
    }
    redirect_to("?mod=cart&action=showCart");
}

function checkoutAction()
{
    // chuyển hướng khi người dùng chưa đăng nhập
    $_SESSION['checkout'] = true;
    // nếu chưa login sẽ chuyển login
    if (!is_login()) {
        redirect_to("?mod=user&action=login");
        die;
    }
    // đây là khúc đã login
    unset($_SESSION['checkout']);
    // check có sản phẩm trong cart k nếu k sẽ đẩy ra cart show
    if (get_cart_order() == false) {
        redirect_to("?mod=cart&action=showCart");
    }
    global $error, $fullname, $email, $address, $note, $phone;
    $error = array();
    // set data default of customer
    $user = session_login();
    $fullname = $user['fullname'];
    $email = $user['email'];
    $address = $user['address'];
    $phone = $user['phone'];
    // validate
    if (isset($_POST['btn_checkout'])) {
        $orders = $_POST;
        // fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống tên";
        } else {
            if (is_lenght($_POST['fullname'])) {
                $fullname = vali_string($_POST['fullname']);
            } else {
                $error['fullname'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        // address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ";
        } else {
            if (is_lenght($_POST['address'])) {
                $address = vali_string($_POST['address']);
            } else {
                $error['address'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        // email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống mail";
        } else {
            if (is_lenght($_POST['email'])) {
                if (is_email($_POST['email'])) {
                    $email = $_POST['email'];
                }
            } else {
                $error['email'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        // phone
        if (empty($_POST['phone'])) {
            $error['phone'] = "Không được để trống số điện thoại";
        } else {
            if (is_lenght($_POST['phone'])) {
                if (is_numberphone($_POST['phone'])) {
                    $phone = vali_string($_POST['phone']);
                }
            } else {
                $error['phone'] = "Độ dài Tối thiểu 6 ký tự";
            }
        }
        // note
        $note = vali_string($_POST['note']);
        // payment_method
        if (empty($_POST['payment_method'])) {
            $error['payment_method'] = "Bạn phải chọn hình thức thanh toán";
        } else {
            $payment_method = vali_string($_POST['payment_method']);
        }
        if (empty($error)) {
            // remove btn_checkout orders
            unset($orders['btn_checkout']);
            // add field products(json)
            $cart_order['order'] = get_cart_order();
            // add field total and numorder xử lý trong admin
            foreach ($cart_order as &$cart) {
                $cart_order['info'] = get_cart_info();
            }
            $orders['products'] = json_encode($cart_order);
            // add field user_id
            $orders['user_id'] = session_login()['id'];
            // add field code
            $orders['code'] = create_code_checkout();
            // add field created_at
            $orders['created_at'] = get_date_now();
            // add field info
            // add database: orders
            add_order($orders);
            // data template mail
            $mail = checkout_mail($orders);
            $subject_mail = "Xác nhận đơn hàng #{$orders['code']}-{$fullname}";
            send_email(sender, mail, $fullname, $email, $subject_mail, $mail);
            // delete all cart
            redirect_to("?mod=cart&action=delete");
        }
    }
    $carts = get_cart_order();
    $info = get_cart_info();
    $data = [
        'carts' => $carts,
        'info' => $info
    ];
    load_view('checkout', $data);
}
