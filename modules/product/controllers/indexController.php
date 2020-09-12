<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    // get url seach box ajax
    if (!empty($_GET['seach'])) {
        $_SESSION['seach'] = $_GET['seach'];
    }
    $_SESSION['slug'] = empty($_GET['slug']) ? "" : $_GET['slug'];
    $data = array(
        'brands' => get_brands_product(),
        'cat_title' => get_cats_by_slug($_SESSION['slug'])
    );
    load_view('index', $data);
}

function getListProductAction()
{
    if (!empty($_SESSION['seach'])) {
        $seach = $_SESSION['seach'];  
    } else {
        $seach = NULL;
    }
    $seach = $_GET['seach'] ?? $seach;
    $sort  = $_GET['sort'] ?? NULL;
    $stars = $_GET['star'] ?? NULL;
    $price = $_GET['price'] ?? NULL;
    $brand = $_GET['brand'] ?? NULL;
    $page  = !empty($_GET['page']) ?$_GET['page']: 1;
    // Tạo cổng đầu tiên
    if (boolval($_GET['auto_load'])) {
        // sao 1 quá trình unset session session tránh lỗi
        if(!empty($_SESSION['seach'])){
            unset($_SESSION['seach']);
        }
        // Lấy thông tin
        $total = get_total($seach, $stars, $brand, $price);
        $info = info_paginate($total, $page);
        $start = $info['start'];
        $num_per_page = $info['num_per_page'];
        $num_page = $info['num_page'];
        $products = get_products($start, $num_per_page, $seach, $stars, $brand, $price, $sort);
        $products = empty($products) ? false : $products;
        $paginate = paginate($num_page);
        // nối mảng giữa database để có được qty selled
        if (!empty($products)) {
            foreach ($products as &$product) {
                $product['qty'] = get_qty_selled_by_id($product['id']);
            };
        }
        $send = array(
            'send' => $products,
            'paginate' => $paginate,
            'num_page' => $num_page,
            'seach'=>$seach
        );
        echo json_encode($send);
    }
}

function detailsAction()
{
    /**
     * 
     * $cat_id: yếu tố lấy danh sách sản phẩm cùng cat hay để lấy cat title
     * 
     * $id: yếu tố lấy comment theo sản phẩm và nhận số điểm theo sản phẩm, loại bỏ sản phẩm trong danh sách sản phẩm cùng danh mục
     * 
     */
    global $error, $content_comment, $score;
    // nếu như k tồn tại slug cat_id url chuyển hướng ra  trang chi tiết
    if (empty($_GET['slug']) || empty($_GET['cat_id']))
        redirect_to("?mod=product");
    $slug = $_GET['slug'];
    $cat_id = $_GET['cat_id'];
    $product = get_product_by_slug($slug);
    $id = $product['id'];
    $products_same = get_products_same_category($cat_id, $id);
    $comments = get_comments_by_id($id);
    $score = get_score_comment_by_id($id);
    // session lưu danh sách id sản phẩm mà người dùng đã truy cập
    product_visited($id);
    // get cat by id
    $data = [
        'cat_id' => $cat_id,
        'product' => $product,
        'products_same' => $products_same,
        'coments' => $comments,
        'score' => $score
    ];
    if ($product['slug'] == []) {
        redirect_to("?mod=product");
    }
    // comment
    if (isset($_POST['btn-post'])) {
        $error = [];
        // scrore
        if (empty($_POST['score'])) {
            $error['score'] = "Bạn hãy chọn trạng thái của mình";
        } else {
            $score = intval($_POST['score']);
            // Chống hack
            if ($score > 5)
                $score = 5;
        }
        // content comment
        if (empty($_POST['content'])) {
            $error['content'] = "Không được bỏ trống comment";
        } else {
            if (strlen($_POST['content']) < 10) {
                $error['content'] = "Số từ lớn hơn 10";
            } else {
                $content = vali_string($_POST['content']);
            }
        }
        if (empty(is_login())) {
            $error['comment'] = "Bạn cần đăng nhập để thực hiện hành động";
        }
        if (empty($error)) {
            // add field 
            $user_id = session_login()['id'];
            $product_id = $product['id'];
            $created_at = get_date_now();
            $comment = [
                'stars' => $score,
                'user_id' => $user_id,
                'product_id' => $product_id,
                'created_at' => $created_at,
                'content' => $content
            ];
            // insert db
            add_comment($comment);
            // reload
            redirect_to("?mod=product&action=details&cat_id={$cat_id}&slug={$slug}");
        }
    }

    load_view('detais', $data);
}

function replyCommentAction()
{
    if (is_login() && !empty($_POST['status'])) {
        // get data
        $parent_id = intval($_POST['parent_id']);
        $product_id = intval($_POST['product_id']);
        $content = vali_string($_POST['content']);
        $user_id = session_login()['id'];
        if (get_comment_by_product_id($parent_id, $product_id)) {
            $comment = array(
                'parent_id' => $parent_id,
                'product_id' => $product_id,
                'user_id' => $user_id,
                'created_at' => get_date_now(),
                'content' => $content
            );
            add_reply_comment($comment);
            echo json_encode(array('status' => true));
        }
    } else {
        // error
        echo json_encode(array('status' => false, 'content' => "Bạn cần đăng nhập"));
    }
}
