<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    $data = array(
        'total' => num_status(),
        'show' => num_status('show'),
        'hide' => num_status('hide')
    );
    load_view('index', $data);
}
# add cat
function addCatAction()
{
    # show option view
    $data['cats'] = data_tree(get_cats());
    # validiion
    if (isset($_POST['btn-add'])) {
        global $error, $cat_post, $title, $slug;
        $error = array();
        # cat title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trong tiêu đề danh mục ";
        } else {
            if (strlen($_POST['title']) > 2 && strlen($_POST['title']) < 100) {
                $title = vali_string($_POST['title']);
            } else {
                $error['title'] = "Độ dài Tiêu đề 3-99 từ";
            }
        }
        #slug 
        if (empty($_POST['slug'])) {
            $catPosts = slug($title);
        } else {
            if (strlen($_POST['slug']) > 2 && strlen($_POST['slug']) < 100) {
                $slug = vali_string($_POST['slug']);
            } else {
                $error['slug'] = "Độ dài slug 3-99 từ";
            }
        }
        # add cat
        if (empty($error)) {
            $cat_post = $_POST;
            // người dùng không nhập thì sẽ là 0
            $cat_post['parent_id'] = intval($_POST['parent_id']);
            // loại bỏ trường btn-add
            unset($cat_post['btn-add']);
            // thêm trường ngày tạo cho cat
            $cat_post['created_at'] = get_date_now();
            add_cat_post($cat_post);
            redirect_to(base_url("?mod=post&action=listCat"));
        }
    }
    load_view('add_cat', $data);
}

# list cat
function listCatAction()
{
    load_view('list_cat');
}

function addPostAction()
{
    $cats = get_cats();
    $data['cats'] = data_tree($cats);
    // validition
    if (isset($_POST['btn_add'])) {
        global $error, $title, $desc, $slug, $content;
        $error = array();
        $post = $_POST;
        // title
        if (empty($_POST['title'])) {
            $error['title'] = "Bạn Không được để trống tiêu đề bài viết";
        } else {
            if (strlen($_POST['title']) > 5 && strlen($_POST['title']) < 100) {
                $title = $_POST['title'];
            } else {
                $error['title'] = "Độ dài 6-99 ký tự";
            }
        }
        // slug
        $post['slug'] = slug($_POST['slug']);
        // post desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "Bạn Không được để trống mô tả bài viết";
        } else {
            if (strlen($_POST['desc']) > 5) {
                $desc = $_POST['desc'];
            } else {
                $error['desc'] = "Độ dài tiếu thiểu 6 ký tự";
            }
        }
        // post content
        if (empty($_POST['content'])) {
            $error['content'] = "Bạn Không được để trống tiêu đề bài viết";
        } else {
            if (strlen($_POST['content']) > 5) {
                $content = $_POST['content'];
            } else {
                $error['content'] = "Độ dài tiếu thiểu 6 ký tự";
            }
        }
        // cat parent
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Bạn Không được để trống Danh mục";
        } else {
            $post['cat_id'] = $_POST['parent_id'];
        }
        // thumbnail
        if (!empty($_FILES['thumbnail']['name'][0] && empty($error))) {
            // move file folder post 
            $dir_upload = "public/images/posts/";
            $post['thumbnail'] = multiple_upload('thumbnail', $dir_upload, $title)[0];
        }
        if (empty($error)) {
            // thêm trường ngày tạo
            $post['created_at'] = get_date_now();
            // thêm trường người tạo
            $post['user_id'] = session_login()['id'];
            // bỏ trường btn-add
            unset($post['btn_add'], $post['parent_id']);
            add_post($post);
            redirect_to(base_url("?mod=post&action=index"));
        }
    }
    load_view('add_post', $data);
}

function getCatPostAjaxAction()
{
    $total = count_cat();
    $info_paginate_cat = info_paginate($total, $page = 1);
    $start = $info_paginate_cat['start'];
    $num_per_page = $info_paginate_cat['num_per_page'];
    $num_page = $info_paginate_cat['num_page'];
    /**
     * array_slice đóng vai trò như limit sql
     * ở đây ta lấy all csdl và dùng array_slice phân ra
     * 
     */
    $cats = cat_posts();
    $cats = data_tree($cats);
    $cats = array_slice($cats, $start, $num_per_page);
    if (!empty($cats)) {
        $temp = 0;
        $cat = "";
        foreach ($cats as $value) {
            $temp++;
            $cat .= "<tr>";
            $cat .= "<td><input type='checkbox' name='checkItem' class='checkItem'></td>";
            $cat .= "<td><span class='tbody-text'>" . $temp . "</h3></span>";
            $cat .= "<td class='clearfix'>";
            $cat .= "<div class='tb-title fl-left'><a href='' title=''>" . str_repeat("--", $value['level']) . $value['title'] . "</a></div>";
            $cat .= "<ul class='list-operation fl-right'><li><a href='" . base_url("?mod=post&action=updateCat&cat_id={$value['id']}") . "' title='Sửa' class='edit'><i class='fas fa-pencil-alt'></i></a></li><li><a href='' title='Xóa' class='delete'><i class='fa fa-trash' aria-hidden='true'></i></a></li></ul>";
            $cat .= "<td><span class='tbody-text'>Hoạt động</span></td>
            <td><span class='tbody-text'>" . $value['slug'] . "</span></td>
            <td><span class='tbody-text'>" . $value['created_at'] . "</span></td>";
            $cat .= "</tr>";
        };
    // nếu k có bản ghi nào sẽ in ra
    } else {
        $cat = 'No record cat';
    }
    $data_send = array(
        'send' => $cat,
        'paginate' => paginate($num_page)
    );
    echo json_encode($data_send);
}

function updateCatAction()
{
    // global
    global $title, $slug, $error;
    // get all list cat
    $cats = get_cats();
    $data['cats'] = data_tree($cats);
    // get cat by id
    $id = intval($_GET['cat_id']);
    $data['cat'] = get_cat_by_id($id);
    // truyền dữ liệu mặc định qua view
    $title = $data['cat']['title'];
    $slug = $data['cat']['slug'];
    $parent_id = $data['cat']['parent_id'];
    $data['cat_parent'] = get_cat_by_id($parent_id);
    // validiton
    if (isset($_POST['btn-add'])) {
        $error = array();
        // cat title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trong tiêu đề danh mục ";
        } else {
            if (strlen($_POST['title']) > 2 && strlen($_POST['title']) < 100) {
                $title = vali_string($_POST['title']);
            } else {
                $error['title'] = "Độ dài Tiêu đề 3-99 từ";
            }
        }
        // slug
        if (empty($_POST['slug'])) {
            $cat['slug'] = slug($_POST['title']);
        } else {
            $cat['slug'] = slug($_POST['slug']);
        }
        // không cập nhật danh mục cha chứa danh mục con
        if (check_parent($id)) {
            $error['parent_id'] = 'Không thể cập nhật danh mục cha k còn danh mục con';
        };
        if (empty($error)) {
            $cat_post = $_POST;
            // người dùng không nhập thì sẽ là 0
            $cat_post['parent_id'] = intval($_POST['parent_id']);
            // loại bỏ trường btn-add
            unset($cat_post['btn-add']);
            update_cat_post($cat_post, $id);
            redirect_to(base_url("?mod=post&action=listCat"));
        }
    }
    load_view('add_cat', $data);
}

function getListAjaxAction()
{
    /*
        chức năng seach nhỏ list product
    */
    if (!empty($_GET["box_seach"])) {
        $seach = $_GET['box_seach'];
        $data = "";
        $list_data = get_posts_seach($seach);
        foreach ($list_data as $value) {
            $data .= "<li><a href=''>{$value['title']}</a></li>";
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
        $seach = ($_GET['seach']) ?? NULL;
        $total = count_post($seach);
        $info = info_paginate($total, $page);
        $start = $info['start'];
        $num_page = $info['num_page'];
        $num_per_page = $info['num_per_page'];
        $posts = get_posts($start, $num_per_page, $seach, $sort);
        $post = "";
        $temp = 0;
        // checked sẽ quy đinh trang thái nút check box
        $checked = array(
            'show' => 'checked',
            'hide' => ''
        );
        foreach ($posts as $value) {
            $temp++;
            $post .= "<tr>";
            $post .= "<td><span class='tbody-text'>" . $temp . "</h3></span></td>";
            $post .= "<td class='clearfix'><div class='tb-title fl-left'>";
            $post .= "<a href='' title=''>" . $value['title'] . "</a>";
            $post .= "</div>";
            $post .= "<ul class='list-operation fl-right'><li><a href='?mod=post&action=updatePost&id=" . $value['id'] . "' title='Sửa' class='edit'><i class='fas fa-pencil-alt'></i></a></li>";
            $post .= "<li><a href='" . $value['title'] . "' data-id='{$value['id']}' title='Xóa' class='delete'><i class='fa fa-trash' aria-hidden='true'></i></a></li>";
            $post .= "</ul></td>";
            $post .= "<td><div class='tbody-thumb'><img src='" . $value['thumbnail'] . "'></div></td>";
            $post .= "<td><span class='tbody-text'>" . get_cat_by_id($value['cat_id'])['title'] . "</span></td>";
            $post .= "<td><input type='checkbox' data-id='" . $value['id'] . "' class='btn-toggle-status'{$checked[$value['status']]}></td>";
            $post .= "<td><span class='tbody-text'>" . get_creator_by_id($value['user_id']) . "</span></td>";
            $post .= "<td><span class='tbody-text'>" . $value['created_at'] . "</span></td>";
            $post .= "</tr>";
        }
        $paginate = paginate($num_page, $page);
        $data_post = array(
            'send' => $post,
            'paginate' => $paginate,
            'test' => $seach
        );
        echo json_encode($data_post);
    }
    //   Cổng thi hành checkbox

    if (!empty($_GET['id'])) {
        // quy đổi true false để update
        $checked = array(
            'true' => 'show',
            'false' => 'hide',
        );
        $data_update = array(
            'status' => $checked[$_GET['status']]
        );
        upload_post($data_update, $_GET['id']);
        // return publish pending
        $data_return = array(
            'show' => num_status('show'),
            'hide' => num_status('hide')
        );
        echo json_encode($data_return);
    }
}
function updatePostAction()
{
    $id = intval($_GET['id']);
    // get post by id
    $post = get_post_by_id($id);
    // chuyển hướng nếu id không tồn tại
    if (count($post) == 0)
        redirect_to("?mod=product&action=listProduct");
    //  show post cat_parent để selected danh m
    $data = array(
        'cat_parent' => get_cat_by_id($post['cat_id'])['title'],
        'cats' => data_tree(get_cats()),
        'thumbnail' => $post['thumbnail'],
        'status' => $post['status']
    );
    // set value
    global $error, $title, $desc, $slug, $content, $thumbnail;
    // set value field
    $title = $post['title'];
    $content = $post['content'];
    $desc = $post['desc'];
    $slug = $post['slug'];
    $content = $post['content'];
    $thumbnail = $post['thumbnail'];
    // validate
    if (isset($_POST['btn_add'])) {
        $error = array();
        // đây là post chứa danh sach input làm mới từ post theo id
        $post = $_POST;
        // title
        if (empty($_POST['title'])) {
            $error['title'] = "Bạn Không được để trống tiêu đề bài viết";
        } else {
            if (strlen($_POST['title']) > 5 && strlen($_POST['title']) < 100) {
                $title = $_POST['title'];
            } else {
                $error['title'] = "Độ dài 6-99 ký tự";
            }
        }
        // nếu k nhập slug thì sẽ lấy title
        if (empty($_POST['slug'])) {
            $post['slug'] = slug($_POST['title']);
        } else {
            $post['slug'] = slug($_POST['slug']);
        }
        // post desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "Bạn Không được để trống mô tả bài viết";
        } else {
            if (strlen($_POST['desc']) > 5) {
                $desc = $_POST['desc'];
            } else {
                $error['desc'] = "Độ dài tiếu thiểu 6 ký tự";
            }
        }
        // post content
        if (empty($_POST['content'])) {
            $error['content'] = "Bạn Không được để trống tiêu đề bài viết";
        } else {
            if (strlen($_POST['content']) > 5) {
                $content = $_POST['content'];
            } else {
                $error['content'] = "Độ dài tiếu thiểu 6 ký tự";
            }
        }
        # status
        $post['status'] = $_POST['status'];
        // upload
        if (!empty($_FILES['thumbnail']['name'][0]) && empty($error)) {
            $dir_upload = "public/images/posts/";
            $post['thumbnail'] = multiple_upload('thumbnail', $dir_upload, $title)[0];
            if (file_exists($data['thumbnail'])) {
                unlink($data['thumbnail']);
            };
        }
        if (empty($error)) {
            // thêm trường cat_id
            $post['cat_id'] = $post['parent_id'];
            // Bỏ trường không cần thiết
            unset($post['btn_add'], $post['parent_id']);
            upload_post($post, $id);
            redirect_to(base_url("?mod=post"));
        }
    };
    load_view('add_post', $data);
}

function deletePostAction()
{
    /* 
    *   xóa 2 bảng list_page và cat page
    *   xóa ảnh đại diện
    */
    $id = intval($_GET['id']);
    $thumb_page = get_post_by_id($id)['thumb_post'];
    if (file_exists($thumb_page)) {
        unlink($thumb_page);
    }
    delete_post($id);
}
