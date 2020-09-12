<?php
// show cat option form

function get_cats($id = "")
{
    global $conn;
    $where = !empty($id) ? "WHERE `id`='{$id}'" : "";
    $sql = "SELECT * FROM `cat_posts` {$where}";
    $result = db_fetch_array($sql);
    return $result;
}
// nhận cat bằng id
function get_cat_by_id($id)
{
    $sql = " SELECT * FROM `cat_posts` WHERE `id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}
// add cat action add cat
function add_cat_post($cat_post)
{
    db_insert('cat_posts', $cat_post);
}

# seach và tìm tổng bảng ghi
function count_cat($seach = "")
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sql = "SELECT COUNT(`id`) AS `total` FROM `cat_posts` {$seach} ";
    $result = db_fetch_row($sql);
    return $result['total'];
}

function cat_posts()
{
    $sql = "SELECT * FROM `cat_posts`";
    $result = db_fetch_array($sql);
    return $result;
}

// update cat post

function update_cat_post($cat_post, $id)
{
    $where = "`id`='{$id}'";
    db_update('cat_posts', $cat_post, $where);
}

// đây là hàm kiểm tra xem id cat mình có là danh mục cha chứa còn nào k
function check_parent($id)
{
    $sql = "SELECT * FROM `cat_posts` WHERE `parent_id`='{$id}'";
    if (db_num_rows($sql) > 0) {
        return true;
    }
    return false;
}

function num_status($status = "")
{
    $where = empty($status) ? "" : "WHERE `status`='{$status}'";
    $sql = "SELECT COUNT(`id`) as `total` FROM `posts` $where";
    $result = db_fetch_row($sql);
    return $result['total'];
}
# add post

function add_post($post)
{
    db_insert('posts', $post);
}
// Nhận người tạo trang thông qua id

function get_creator_by_id($id)
{
    $sql = "SELECT `fullname` FROM `users` WHERE `id`='{$id}'";
    $creator = db_fetch_row($sql);
    return $creator['fullname'];
}

function get_posts_seach($seach)
{
    global $conn;
    $seach = mysqli_escape_string($conn, $seach);
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sql = "SELECT * FROM `posts` {$seach} ";
    $result = db_fetch_array($sql);
    return $result;
}
# seach và tìm tổng bảng ghi
function count_post($seach = "")
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sql = "SELECT COUNT(`id`) AS `total` FROM `posts` {$seach} ";
    $result = db_fetch_row($sql);
    return $result['total'];
}

function get_posts($start, $num_per_page, $seach, $order)
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $order = !empty($order) ? "ORDER BY `created_at` $order" : "";
    $sql = "SELECT * FROM `posts` {$seach} {$order} LIMIT {$start},{$num_per_page}";
    $result = db_fetch_array($sql);
    return $result;
}

function get_post_by_id($id)
{
    $sql = "SELECT * FROM `posts` WHERE `id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

function upload_post($data, $id)
{
    $where = "`id`='{$id}'";
    db_update('posts', $data, $where);
}

function delete_post($id)
{
    $where = "`id`='{$id}'";
    db_delete('posts', $where);
}
