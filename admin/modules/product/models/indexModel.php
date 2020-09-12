<?php
function get_cats($id = "")
{
    $where = !empty($cat_id) ? "WHERE `id`='{$id}'" : "";
    $sql = "SELECT * FROM `cat_products` {$where}";
    $result = db_fetch_array($sql);
    return $result;
}

// đây là hàm kiểm tra xem id cat mình có là danh mục cha chứa còn nào k
function check_parent($id)
{
    $sql = "SELECT * FROM `cat_products` WHERE `parent_id`='{$id}'";
    if (db_num_rows($sql) > 0) {
        return true;
    }
    return false;
}

function get_creator_by_id($id)
{
    $sql = "SELECT `fullname` FROM `users` WHERE `id`='{$id}'";
    $creator = db_fetch_row($sql);
    return $creator['fullname'];
}

function add_cat_post($cat)
{
    db_insert('cat_products', $cat);
};

// nhận cat bằng id
function get_cat_by_id($id)
{
    $sql = " SELECT * FROM `cat_products` WHERE `id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

// seach và tìm tổng bảng ghi
function count_cat($seach = "")
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sql = "SELECT COUNT(`id`) AS `total` FROM `cat_products` {$seach} ";
    $result = db_fetch_row($sql);
    return $result['total'];
}

// list post

function get_cat_products()
{
    $sql = "SELECT * FROM `cat_products`";
    $result = db_fetch_array($sql);
    return $result;
}

function update_cat_product($cat, $id)
{
    $where = "`id`='{$id}'";
    db_update('cat_products', $cat, $where);
}


// add_product
function add_product($product)
{
    return db_insert('products', $product);
}
// đây là hàm insert vào bảng kho hàng
function add_depot($depot)
{
    return db_insert('depots', $depot);
}

function get_list_product_seach($seach = "")
{
    global $conn;
    $seach = mysqli_escape_string($conn, $seach);
    $sql = "SELECT * FROM `products` WHERE `title` LIKE '%{$seach}%' LIMIT 0,5 ";
    $result = db_fetch_array($sql);
    return $result;
}

function count_product($seach = "")
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sql = "SELECT COUNT(`id`) as `total` FROM `products` {$seach}";
    $result = db_fetch_row($sql);
    return $result['total'];
}

function get_products($start, $num_per_page, $seach, $sort)
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sort = !empty($sort) ? "ORDER BY `price` {$sort} " : "";
    $sql = "SELECT * FROM `products` {$seach}  {$sort} LIMIT {$start},{$num_per_page} ";
    $result = db_fetch_array($sql);
    return $result;
};

/*
* get product by id hiển thị thông tin sản phẩm
* theo id url
*/
function get_product_by_id($id)
{
    $sql = "SELECT * FROM `products` WHERE `id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

function get_slider_product_by_id($id)
{
    $sql = "SELECT * FROM `tbl_thumb_product` WHERE `product_id`='{$id}'";
    $result = db_fetch_array($sql);
    return $result;
}

/*
* Nhận danh sách tổng số sản phẩm. số quyền sản phẩm
* nav status
*/
function num_status($status = "")
{
    $where = empty($status) ? "" : "WHERE `status`='{$status}'";
    $sql = "SELECT COUNT(`id`) as `total` FROM `products` $where";
    $result = db_fetch_row($sql);
    return $result['total'];
}

// upload bảng list product
function update_product($product, $id)
{
    $where = "`id`='{$id}'";
    db_update('products', $product, $where);
}

function update_depots($qty, $product_id)
{
    $where = "`product_id`='{$product_id}'";
    db_update('depots', $qty, $where);
}

function delete_product($id)
{
    db_delete('products', "`id`='{$id}'");
}
