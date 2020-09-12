<?php

function construct()
{
    load_model('index');
}
// add Page
function addPageAction()
{
    if (isset($_POST['btn_add'])) {
        global $error, $title, $content, $slug;
        $page = $_POST;
        $error = [];
        // page title
        if (empty($_POST['title'])) {
            $error['title'] = "Bạn không được để trống tiêu đề bài viết";
        } else {
            if (is_length_text($_POST['title'])) {
                $title = $_POST['title'];
            } else {
                $error['title'] = "Độ dài tối thiểu 6 ký tự";
            }
        }
        // page content
        if (empty($_POST['content'])) {
            $error['content'] = "Bạn không được để trống Nội Dung Trang";
        } else {
            if (is_length_text($_POST['content'])) {
                $content = $_POST['content'];
            } else {
                $error['content'] = "Độ dài tối thiểu 6 ký tự";
            }
        }
        // slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Bạn không được để trống Link Thân Thiện Trang";
        } else {
            if (is_length_text($_POST['slug'])) {
                // mod text - slug
                $slug = slug($_POST['slug']);
            } else {
                $error['slug'] = "Độ dài tối thiểu 6 ký tự";
            }
        };
        // nếu người dùng upload ảnh
        if (!empty($_FILES['thumbnail']['name'][0])) {
            $dir_upload = "public/images/pages/";
            $page['thumbnail'] = multiple_upload('thumbnail', $dir_upload, $title)[0];
        }
        if (empty($error)) {
            $page['user_id'] = session_login()['id'];
            // loại name nut thêm vì sẽ bị lỗi
            unset($page['btn_add']);
            // thêm trường thời gian tạo
            $page['created_at'] = get_date_now();
            add_page($page);
            // vẫn dụng session flash laravel
            $success = "Thêm Trang" . $page['title'] . 'Thành công !!';
            redirect_to(base_url("?mod=page&action=listPage"));
        }
    };
    load_view('add_page');
}
function listPageAjaxAction()
{
    # mini seach

    if (!empty($_GET["box_seach"])) {
        $seach = $_GET['box_seach'];
        $data = "";
        $list_data = get_pages_seach($seach);
        foreach ($list_data as $value) {
            $data .= "<li><a href=''>{$value['title']}</a></li>";
        }
        echo $data;
    }
    if (isset($_GET['seach'])) {
        /*
        * info client
        * page: info page current
        * sort: desc, asc
        * seach :seach
        */
        $page = empty($_GET['page']) ? 1 : $_GET['page'];
        $sort = $_GET['sort'] ?? NULL;
        $seach = $_GET['seach'] ?? NULL;
        $total = count_page($seach);
        $info = info_paginate($total, $page);
        $start = $info['start'];
        $num_page = $info['num_page'];
        $num_per_page = $info['num_per_page'];
        $pages = get_pages($start, $num_per_page, $seach, $sort);
        $page = "";
        $temp = 0;
        // role sẽ quy đinh trang thái nút check box
        $role = ['show' => 'checked', 'hide' => ''];
        foreach ($pages as $value) {
            $url_update = base_url("?mod=page&action=updatePage&id={$value['id']}");
            $user = get_creator_by_id($value['user_id']);
            $status = $role[$value['status']];
            $temp++;
            $page .= "<tr>";
            $page .= "<td><span class='tbody-text'> {$temp}</h3></span><div class='tbody-thumb'></td>";
            $page .= "<td><div class='tbody-thumb'><img src=' {$value['thumbnail']} '></div></td>";
            $page .= "<td class='clearfix'><div class='tb-title fl-left'>";
            $page .= "<a href=''> {$value['title']} </a></div>";
            $page .= "<ul class='list-operation fl-right'>";
            $page .= "<li><a href=' {$url_update} ' title='Sửa' class='edit'><i class='far fa-edit'></i></i></a></li>";
            $page .= "<li><a href='' title='Xóa' data-id=' {$value['id']} ' class='delete'><i class='fa fa-trash' aria-hidden='true'></i></a></li></ul></td>";
            $page .= "<td><span class='tbody-text'> {$user} </span></td>";
            $page .= "<td><input type='checkbox' data-id=' {$value['id']} ' class='btn-toggle-status' {$status} ></td>";
            $page .= "<td><span class='tbody-text'> {$value['created_at']} </span></td></tr>";
        }
        // get pagging
        $paginate = paginate($num_page, $page);
        $data_send = [
            'send' => $page,
            'paginate' => $paginate,
            'test' => $seach
        ];
        echo json_encode($data_send);
    }

    if (!empty($_GET['id'])) {
        // nếu check true thì show ngược lại là hide
        $check = ['true' => 'show', 'false' => 'hide',];
        $status = ['status' => $check[$_GET['status']]];
        update_page($status, $_GET['id']);
        // return number status publish pending page
        $data_return = [
            'publish' => num_status('show'),
            'pending' => num_status('hide')
        ];
        echo json_encode($data_return);
    }
}
function listPageAction()
{
    $data = [
        'total' => num_status(),
        'show' => num_status('show'),
        'hide' => num_status('hide')
    ];
    load_view('list_page', $data);
};
function deleteAction()
{
    /* 
    *   xóa 2 bảng pages
    *
    *   xóa ảnh đại diện
    */
    $id = intval($_GET['id']);
    $thumbnail = get_page_by_id($id)['thumbnail'];
    if (file_exists($thumbnail)) {
        unlink($thumbnail);
    }
    delele_page_by_id($id);
};


function updatePageAction()
{
    /**
     * 
     * data['page'] là phần gửi sang view nhé
     * 
     * check nếu thay đôi bậy url sẽ chuyển hướng
     */
    // get id page url
    $id = !empty($_GET['id']) ? intval($_GET['id']) : "";
    $data['page'] = get_page_by_id($id);
    if (empty($data['page']))
        redirect_to("?mod=page&action=listPage");
    $thumbnail_old = $data['page']['thumbnail'];;
    // validtion
    if (isset($_POST['btn_add'])) {
        global $error;
        $error = array();
        $page = $_POST;
        // page title
        if (empty($_POST['title'])) {
            $error['title'] = "Bạn không được để trống tiêu đề bài viết";
        } else {
            if (is_length_text($_POST['title'])) {
                $title = vali_string($_POST['title']);
            } else {
                $error['title'] = "Độ dài tối thiểu 6 ký tự";
            }
        }
        // page content
        if (empty($_POST['content'])) {
            $error['content'] = "Bạn không được để trống Nội Dung Trang";
        } else {
            if (is_length_text($_POST['content'])) {
                $content =  vali_string($_POST['content']);
            } else {
                $error['content'] = "Độ dài tối thiểu 6 ký tự";
            }
        }
        // status
        $status = $_POST['status'];
        if (!empty($_FILES['thumbnail']['name'][0]) && empty($error)) {
            /*
            *  user asset change picture
            *  Thêm điều kiện error vì Người dùng upload mà sai thông tin trên dẫn đến page title  không khả dụng
            */
            $dir_upload = "public/images/pages/";
            $page['thumbnail'] = multiple_upload('thumbnail', $dir_upload, $title)[0];
            if (file_exists($thumbnail_old)) {
                unlink($thumbnail_old);
            }
        }
        if (empty($error)) {
            // thêm trường user_id page
            $page['user_id'] = session_login()['id'];
            // thêm trường time
            $page['updated_at'] = get_date_now();
            // xóa trường btn_add
            $page['slug'] = slug($page['title']);
            unset($page['btn_add']);
            //  Khắc phục lỗi người dùng up sai định dạng nhưng xóa file cũ
            // update database
            update_page($page, $id);
            redirect_to("?mod=page&action=listPage");
        };
    }
    load_view('update_page', $data);
}
