<?php

function get_status()
{
    $sql = "SELECT * FROM `tbl_status`";
    $result = db_fetch_array($sql);
    return $result;
}

// add page database
function add_page($info_page)
{
    db_insert('pages', $info_page);
}

// thêm vài key mảng thực hiện các chức năng delete và edit
function add_url($list_data)
{
    if (!empty($list_data)) {
        foreach ($list_data as &$value) {
            $value['delete'] = base_url("?mod=page&action=delete&id={$value['id']}&cat_id={$value['cat_id']}");
            $value['editor'] = base_url("?mod=page&action=edit&id={$value['id']}");
        }
    }
    return $list_data;
}

// delete page by id

function delele_page_by_id($id)
{
    // lấy đk xóa 2 bảng riêng lẻ
    $where = "`id`='{$id}'";
    db_delete('pages', $where);
}

/**
 * 
 * Hàm này có nhiêu vụ lấy 1 trang theo id cho trươc
 * 
 * Dữ liệu nhập vào id
 *  
 * Trả về mảng 1 cấp chưa thông tin page
 */

function get_page_by_id($id)
{
    $sql = "SELECT * FROM `pages` WHERE `id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}

// total status tổng,xem, hạn chế 

function num_status($status = "")
{
    $where = empty($status) ? "" : "WHERE `status`='{$status}'";
    $sql = "SELECT COUNT(`id`) as `total` FROM `pages` $where";
    $result = db_fetch_row($sql);
    return $result['total'];
}
// update page

function update_page($page, $id)
{
    $where = "`id`='{$id}'";
    db_update('pages', $page, $where);
}

// ajax mini seach
function get_pages_seach($seach)
{
    global $conn;
    $seach = mysqli_escape_string($conn, $seach);
    $sql = "SELECT * FROM `pages` WHERE `title` LIKE '%{$seach}%'";
    $result = db_fetch_array($sql);
    return $result;
}

// ajax 
function count_page($seach = "")
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sql = "SELECT COUNT(`id`) as `total` FROM `pages` {$seach}";
    $result = db_fetch_row($sql);
    return $result['total'];
}
// Nhận người tạo trang thông qua id

function get_creator_by_id($id)
{
    $sql = "SELECT `fullname` FROM `users` WHERE `id`='{$id}'";
    $creator = db_fetch_row($sql);
    return $creator['fullname'];
}

function get_pages($start, $num_per_page, $seach, $sort)
{
    $seach = !empty($seach) ? "WHERE `title` LIKE '%{$seach}%'" : "";
    $sort = !empty($sort) ? "ORDER BY `title` {$sort} " : "";
    $sql = "SELECT * FROM `pages` {$seach} {$sort} LIMIT {$start},{$num_per_page} ";
    $result = db_fetch_array($sql);
    return $result;
};
