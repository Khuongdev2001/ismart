<?php
// function construct()
// {
//     load_model('index');
// }
// function indexAction()
// {
//     # chuyển hướng khi sai url
//     if (empty($_GET['cat_id']))
//         redirecto("?mod=home");
//     # get info pagging
//     $cat_id = intval($_GET['cat_id']);
//     $seach = empty($_GET['seach']) ? "" : $_GET['seach'];
//     $page = empty($_GET['page']) ? "" : intval($_GET['page']);
//     $info_page = get_info_pagging($seach, $page, $cat_id);
//     $start = $info_page['start'];
//     $num_page = $info_page['num_page'];
//     $num_per_page = $info_page['num_per_page'];
//     // truyền dữ liệu
//     $data = array(
//         'list_post' => get_post_by_cat_id($start, $num_per_page, $seach, $cat_id),
//         'cat_title' => get_cat_by_cat_id($cat_id),
//         'cat_id' => $cat_id,
//         'seach' => $seach,
//         'pagging' => pagging($num_page)
//     );
//     load_view('index', $data);
// }

// function detailsAction()
// {
//     $id = intval($_GET['id']);
//     $cat_id = intval($_GET['cat_id']);
//     $cat_title = get_cat_by_cat_id($cat_id);
//     if (empty($cat_title))
//         redirecto("?mod=home");
//     if (empty($_GET['id']))
//         redirecto("?mod=post&cat_id=2");
//     $data = array(
//         'post' => get_post_by_id($id),
//         'cat_title' => $cat_title,
//         'cat_id' => $cat_id
//     );
//     load_view('details', $data);
// }
