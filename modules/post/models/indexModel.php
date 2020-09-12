<?php
// function get_menu_db()
// {
//     $sql = "SELECT * FROM `tbl_menu`";
//     $result = db_fetch_array($sql);
//     return $result;
// }

// function get_cat_by_cat_id($cat_id)
// {
//     $sql = "SELECT `cat_title` FROM `tbl_cat_post` WHERE `cat_id`='{$cat_id}'";
//     $result = db_fetch_row($sql);
//     return $result['cat_title'];
// }
// /*
// Nhận tổng số bài viết theo seach
// */

// function total_post_seach($seach, $cat_id)
// {
//     $seach = empty($seach) ? "" : "AND `post_title`LIKE'%{$seach}%'";
//     $sql = "SELECT COUNT(`id`) AS `total` FROM `tbl_list_post` WHERE `cat_id`='{$cat_id}' {$seach}";
//     $result = db_fetch_row($sql);
//     return $result['total'];
// }

// /*
// Nhận thông tin để phân trang 
// */

// function get_info_pagging($seach = "", $page, $cat_id)
// {
//     $page = empty($page) ? 1 : $page;
//     $total = total_post_seach($seach, $cat_id);
//     $num_per_page = 2;
//     $num_page = ceil($total / $num_per_page);
//     $start = ($page - 1) * $num_per_page;
//     $result = array(
//         'total' => $total,
//         'num_per_page' => $num_per_page,
//         'num_page' => $num_page,
//         'start' => $start,
//         'page' => $page
//     );
//     return $result;
// }

// function get_post_by_cat_id($start, $num_per_page, $seach, $cat_id)
// {
//     $seach = empty($seach) ? "" : "AND `post_title`LIKE'%{$seach}%'";
//     $sql = "SELECT * FROM `tbl_list_post` WHERE `cat_id`={$cat_id} {$seach} LIMIT {$start},{$num_per_page}";
//     $result = db_fetch_array($sql);
//     return $result;
// }

// /*
// get post by id

// */

// function get_post_by_id($id)
// {
//     $sql = "SELECT * FROM `tbl_list_post` WHERE `id`=$id";
//     $result = db_fetch_row($sql);
//     return $result;
// }
