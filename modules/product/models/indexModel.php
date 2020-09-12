<?php
// nhận qty sell by id 
function get_qty_selled_by_id($id)
{
    $sql = "SELECT * FROM `depots` WHERE `product_id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

// GET LIST CAT DATABASE
function get_cats()
{
    $sql = "SELECT * FROM `cat_products`";
    $result = db_fetch_array($sql);
    return $result;
}

function get_cats_parent_by_id($id)
{
    $sql = "SELECT `id` FROM `cat_products` WHERE `parent_id`={$id}";
    $result = db_fetch_array($sql);
    $ids = NULL;
    // lặp mạng to ghép id mảng con lại với nhau có dấu , trước sẽ đở tốn công nối phần dưới
    foreach ($result as $item) {
        $ids .= ',' . $item['id'];
    }
    return $ids;
}

function get_cats_by_slug($slug)
{
    $sql = "SELECT * FROM `cat_products` where `slug`='{$slug}'";
    $result = db_fetch_row($sql);
    if (!empty($result)) {
        return $result['title'];
    }
    return false;
}


function get_cat_by_id($id)
{
    $sql = "SELECT `title` FROM `products` WHERE `id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result['title'];
}

// chuyển từ slug url sang id sản phẩm cho tiện
function convert_slug_cat_id($slug)
{
    if (empty($slug))
        return false;
    $sql = "SELECT `id`FROM `cat_products` WHERE `slug`='{$slug}'";
    $result = db_fetch_row($sql);
    return $result['id'];
}


// Nhận danh sách hãng database về sidebar bộ lọc

function get_brands_product()
{
    $sql = "SELECT `brand` FROM `products` GROUP BY `brand`";
    $result = db_fetch_array($sql);
    return $result;
}

// Nhận sản  phẩm cùng danh mục random

function get_product_same_cat_rand_db($cat_id)
{
    $sql = "SELECT * FROM `products` WHERE `status`='show' ORDER BY RAND() LIMIT 8";;
    $result = db_fetch_array($sql);
    return $result;
}

// nhận sản phẩm cùng danh mục áp dụng cho action details

function get_products_same_category($cat_id, $id)
{
    /**
     * Tham số 1 lấy sản phẩm cat
     * 
     * Tham số 2 loại bỏ đi sản phẩm hiện có cùng cat
     * 
     * Thêm chức năng random
     */

    $sql = "SELECT * FROM `products` WHERE `cat_id`={$cat_id} AND  NOT `id`={$id} ORDER BY RAND()";
    $result = db_fetch_array($sql);
    return $result;
}

// Nhận danh sản phẩm slug áp dụng details

function get_product_by_slug($slug)
{
    $sql = "SELECT `products`.*,FLOOR(AVG(`stars`)) AS `stars` FROM `products` LEFT JOIN `comments` ON `comments`.`product_id`=`products`.`id` WHERE `status`='show' AND `products`.`slug`='{$slug}'";
    $result = db_fetch_row($sql);
    return $result;
}

function get_product_by_id($product_id)
{   // return product
    $sql = "SELECT * FROM `products` WHERE `id`='{$product_id}'";
    $result = db_fetch_array($sql);
    return $result;
}


// Tính ra total theo thông số phụ thuộc seach brand star price

function get_total($seach, $stars, $brand, $price)
{
    $slug = $_SESSION['slug'] ?? NULL;
    $cat_id = convert_slug_cat_id($slug);
    $seach = empty($seach) ? NULL : "AND `title` LIKE '%{$seach}%'";
    // đây là cách lấy tất cả sản phẩm danh mục cha và con
    $cat = NULL;
    if (!empty($cat_id)) {
        // return ,2,3,4 
        $cat_parents = get_cats_parent_by_id($cat_id);
        // nối với cat ban đầu ra danh sach lun
        $cat_id .= $cat_parents;
        $cat = "AND `cat_id` IN ({$cat_id})";
    }
    // vì star có phần thập phân nữa nên chọn nào có số 4
    $stars = empty($stars) ? NULL : "HAVING FLOOR(AVG(`stars`))={$stars}";
    $brand = empty($brand) ? NULL : "AND `brand`='{$brand}'";
    $price = empty($price) ? NULL : "AND `price` BETWEEN {$price['low_price']} AND {$price['up_price']}";
    $sql = "SELECT AVG(`stars`) FROM `products` LEFT JOIN `comments` ON `comments`.`product_id`=`products`.`id` WHERE `products`.`status`='show' {$cat} {$seach} {$brand} {$price} GROUP BY(`products`.`id`) {$stars}";
    $result = db_num_rows($sql);
    return $result;
}

function get_products()
{
    // get paramator function
    $paramator = func_get_args();
    $start = $paramator[0];
    $num_per_page = $paramator[1];
    $seach = $paramator[2];
    $stars = $paramator[3];
    $brand = $paramator[4];
    $price = $paramator[5];
    $sort = $paramator[6];
    //
    $slug = $_SESSION['slug'] ?? NULL;
    $cat_id = convert_slug_cat_id($slug);
    $sort = empty($sort) ? NULL : "ORDER BY `title` {$sort}";
    $seach = empty($seach) ? NULL : "AND `title` LIKE '%{$seach}%'";
    // get cat_id and cat_child
    $cat = NULL;
    if (!empty($cat_id)) {
        // return ,2,3,4 
        $cat_parents = get_cats_parent_by_id($cat_id);
        // nối với cat ban đầu ra danh sach lun
        $cat_id .= $cat_parents;
        $cat = "AND `cat_id` IN ({$cat_id})";
    }
    // vì star có phần thập phân nữa nên chọn nào có số 4
    $stars = empty($stars) ? NULL : "HAVING FLOOR(AVG(`stars`))={$stars}";
    $brand = empty($brand) ? NULL : "AND `brand`='{$brand}'";
    $price = empty($price) ? NULL : "AND `price` BETWEEN {$price['low_price']} AND {$price['up_price']}";
    $sql = "SELECT AVG(`stars`) as `star`,`products`.* FROM `products` LEFT JOIN `comments` ON `comments`.`product_id`=`products`.`id` WHERE `products`.`status`='show' {$cat} {$seach} {$brand} {$price} GROUP BY(`products`.`id`) {$stars} {$sort} LIMIT {$start},{$num_per_page}";
    $result = db_fetch_array($sql);
    return $result;
}

// Nhận danh sách comment của 1 sản phẩm nào đó áp dụng action details

function get_comments_by_id($product_id)
{   // return comments
    $sql = "SELECT * FROM `comments` WHERE `product_id`='{$product_id}'";
    $result = db_fetch_array($sql);
    return $result;
}

// nhận user by id áp dụng cho action details

function get_user_by_id($user_id)
{
    // return info of user
    $sql = "SELECT * FROM `users` WHERE `id`='{$user_id}'";
    $result = db_fetch_row($sql);
    return $result;
}
// nhận quyền 1 user áp dụng comment action details

function get_role_by_id($user_id)
{   // return name role of user
    // nhận role_id thông qua user_id
    $sql = "SELECT * FROM `user_roles` WHERE `user_id`={$user_id}";
    $role_id = db_fetch_row($sql)['role_id'];
    // nhận role name thông qua role_id
    $sql = "SELECT * FROM `roles` WHERE `id`={$role_id}";
    $role = db_fetch_row($sql)['name'];
    return $role;
}

// Nhận điểm bình luận áp dụng comment và action details

function get_score_comment_by_id($id)
{
    $sql = "SELECT SUM(`stars`=5) as `five`,SUM(`stars`=4) as `four`,SUM(`stars`=3) as `three`,SUM(`stars`=2) as `two`, SUM(`stars`=1) as `one`, COUNT(`stars`) as `total`, Round(AVG(`stars`),1) as `avg` FROM `comments` WHERE `product_id`={$id} AND `stars` IS NOT NULL";
    $result = db_fetch_row($sql);
    return $result;
}


// Thêm comment áp dụng cho action details

function add_comment($comment)
{
    db_insert("comments", $comment);
}

/**
 * 
 * check comment exist
 * 
 * return boolern true:exist and false:dont exist
 * 
 */
function get_comment_by_product_id($parent_id, $product_id)
{
    $sql = "SELECT * FROM `comments` WHERE `product_id`={$product_id} AND `id`={$parent_id}";
    if (db_num_rows($sql) > 0) {
        return true;
    }
    return false;
}

/**
 * 
 * input data field comment
 * id, content, user_id, product_id, stars ,parent_id
 * 
 */
function add_reply_comment($comment)
{
    db_insert('comments', $comment);
}
