<?php

function construct()
{
    load_model('index');
}

function addCatAction()
{
    $data['cats'] = data_tree(get_cats());
    // validiion
    if (isset($_POST['btn-add'])) {
        global $error, $title, $slug;
        $error = array();
        $cat = $_POST;
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
            $cat['slug'] = slug($_POST['title']);
        } else {
            $cat['slug'] = slug($_POST['slug']);
        }
        # add cat
        if (empty($error)) {
            // thêm trường parent_id
            $cat['parent_id'] = intval($_POST['parent_id']);
            // xóa trường btn-add
            unset($cat['btn-add']);
            show_array($cat);
            add_cat_post($cat);
            redirect_to(base_url("?mod=product&action=listCat"));
        }
    }
    load_view("add_cat", $data);
}

function listCatAction()
{
    load_view('list_cat');
}
function getCatProudctAjaxAction()
{
    if (isset($_GET['page'])) {
        /*
        * info client
        * page: thông tin trang hiện tại
        */
        $page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
        $total = count_cat();
        $info_paginate_cat = info_paginate($total, $page);
        $start = $info_paginate_cat['start'];
        $num_per_page = $info_paginate_cat['num_per_page'];
        $num_page = $info_paginate_cat['num_page'];
        // list post
        $cats = get_cat_products();
        $cats = data_tree($cats);
        $cats = array_slice($cats, $start, $num_per_page);
        // multi cat
        if (!empty($cats)) {
            $temp = 0;
            $cat = NULL;
            foreach ($cats as $value) {
                $url_update = base_url("?mod=product&action=updateCat&cat_id={$value['id']}");
                $title = str_repeat("--", $value['level']) . $value['title'];
                $temp++;
                // HTML
                $cat .= "<tr>";
                $cat .= "<td><span class='tbody-text'> {$temp} </span></td>";
                $cat .= "<td class='clearfix'>";
                $cat .= "<div class='tb-title fl-left'><a href=''> {$title} </a></div>";
                $cat .= "<ul class='list-operation fl-right'><li><a href='{$url_update}' title='Sửa' class='edit'><i class='fas fa-pencil-alt'></i></a></li><li><a href='' title='Xóa' class='delete'><i class='fa fa-trash' aria-hidden='true'></i></a></li></ul>";
                $cat .= "<td><span class='tbody-text'>Hoạt động</span></td>";
                $cat .= "<td><span class='tbody-text'> {$value['slug']} </span></td>";
                $cat .= "<td><span class='tbody-text'> {$value['created_at']} </span></td>";
                $cat .= "</tr>";
            };
        } else {
            $cat = 'No record cat';
        }
        $data_send = array(
            'send' => $cat,
            'paginate' => paginate($num_page, $page),
        );
        echo json_encode($data_send);
    }
}
function updateCatAction()
{
    global $title, $slug, $error;
    // get all list cat
    $cats = get_cats();
    $data['cats'] = data_tree($cats);
    // get cat by id
    $id = intval($_GET['cat_id']);
    $cat = get_cat_by_id($id);
    $data['cat'] = $cat;
    $title = $cat['title'];
    $slug = $cat['slug'];
    $parent_id = $cat['parent_id'];
    $data['cat_parent'] = get_cat_by_id($parent_id);
    // validiton
    if (isset($_POST['btn-add'])) {
        $error = array();
        $cat_product = $_POST;
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
        // slug
        if (empty($_POST['slug'])) {
            $cat['slug'] = slug($_POST['title']);
        } else {
            $cat['slug'] = slug($_POST['slug']);
        }
        // cat parent
        if (check_parent($id)) {
            $error['parent_id'] = 'Không thể cập nhật danh mục cha k còn danh mục con';
        };
        # add cat
        if (empty($error)) {
            // người dùng không nhập thì sẽ là 0
            $cat_product['parent_id'] = intval($_POST['parent_id']);
            // loại bỏ trường btn-add
            unset($cat_product['btn-add']);
            update_cat_product($cat_product, $id);
            redirect_to(base_url("?mod=product&action=listCat"));
        }
    }
    load_view('add_cat', $data);
}
function addProductAction()
{
    $data['cats'] = data_tree(get_cat_products());
    if (isset($_POST['btn_add'])) {
        global $error, $title, $price, $price_old, $code, $desc, $brand, $origin, $qty, $content;
        $error = array();
        $product = $_POST;
        //  validition
        // title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được bỏ trống tên sản phẩm";
        } else {
            if (lenght_product($_POST['title'])) {
                $title = $_POST['title'];
            } else {
                $error['title'] = "Độ dài tối thiểu lớn 3";
            }
        }
        // code
        if (empty($_POST['code'])) {
            $error['code'] = "Không được bỏ trống mã sản phẩm";
        } else {
            if (lenght_product($_POST['code'])) {
                $code = $_POST['code'];
            } else {
                $error['code'] = "Độ dài tối thiểu lớn 3";
            }
        }
        // price
        if (empty($_POST['price'])) {
            $error['price'] = "Không được bỏ trống giá mới sản phẩm";
        } else {
            if (intval($_POST['price']) == "") {
                $error['price'] = "Bạn không được phép nhập chữ";
            } else {
                $price = intval($_POST['price']);
            }
        }
        # price_old
        if (!empty($_POST['price_old'])) {
            $price_old = intval($_POST['price_old']);
        }
        # brand
        if (empty($_POST['brand'])) {
            $error['brand'] = "Không được bỏ trống Thương Hiệu";
        } else {
            if (lenght_product($_POST['brand'])) {
                $brand = $_POST['brand'];
            } else {
                $error['brand'] = "Độ dài tối thiểu lớn 3";
            }
        }
        # origin
        if (empty($_POST['origin'])) {
            $error['origin'] = "Không được bỏ trống Xuất xứ sản phẩm";
        } else {
            if (lenght_product($_POST['origin'])) {
                $origin = $_POST['origin'];
            } else {
                $error['origin'] = "Độ dài tối thiểu lớn 3";
            }
        }
        # qty
        if (empty($_POST['qty'])) {
            $error['qty'] = "Không được bỏ trống tổng số lượng sản phẩm ";
        } else {
            if (intval($_POST['qty']) > 0) {
                $qty = $_POST['qty'];
            } else {
                $error['qty'] = "Số lượng ít nhất 1";
            }
        }
        # desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được bỏ trống mô tả sản phẩm sản phẩm";
        } else {
            if (lenght_product($_POST['desc'])) {
                $desc = $_POST['desc'];
            } else {
                $error['desc'] = "Độ dài tối thiểu lớn 3";
            }
        }
        # content
        if (empty($_POST['content'])) {
            $error['content'] = "Không được bỏ trống nội dung sản phẩm";
        } else {
            if (lenght_product($_POST['content'])) {
                $content = $_POST['content'];
            } else {
                $error['content'] = "Độ dài tối thiểu lớn 3";
            }
        }
        # parent_id
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Không được bỏ danh mục sản phẩm";
        }
        if (!empty($_FILES['thumbnail']['name'][0])) {
            // move file folder product 
            $dir_upload = "public/images/products/";
            $product['thumbnail'] = multiple_upload('thumbnail', $dir_upload, $title)[0];
        }
        # product type
        if (empty($error)) {
            // thêm trường người tạo
            $product['user_id'] = session_login()['id'];
            // thêm trường slug
            $product['slug'] = slug($product['title']);
            // thêm trường thời gian tạo
            $product['created_at'] = get_date_now();
            // chuyển đổi trường cat_id
            $product['cat_id'] = $_POST['parent_id'];
            // xóa trường parent_id và btn add
            unset($product['parent_id'], $product['btn_add']);
            $product_id = add_product($product);
            // thêm vào bảng kho
            $depots = ['product_id' => $product_id, 'qty' => $qty];
            add_depot($depots);
            redirect_to("?mod=product&action=listProduct");
        }
    }
    load_view('add_product', $data);
}

function listProductAction()
{
    $data = array(
        'total' => num_status(),
        'show' => num_status('show'),
        'hide' => num_status('hide')
    );
    load_view('index', $data);
}
function getListProductAction()
{
    // chức năng seach nhỏ list product
    if (!empty($_GET["box_seach"])) {
        $seach = $_GET['box_seach'];
        $data = NULL;
        $list_data = get_list_product_seach($seach);
        foreach ($list_data as $value) {
            $data .= "<li><span>{$value['title']}</span></li>";
        }
        echo $data;
    }
    if (isset($_GET['seach'])) {
        /*
         *  thông tin phía client
         *  page: thông tin trang hiện tại
         *  sort: sắp xếp
         *  seach :tìm kiếm
        */
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $sort = $_GET['sort'] ?? NULL;
        $seach = $_GET['seach'] ?? NULL;
        $total = count_product($seach);
        $info = info_paginate($total, $page);
        $start = $info['start'];
        $num_page = $info['num_page'];
        $num_per_page = $info['num_per_page'];
        $products = get_products($start, $num_per_page, $seach, $sort);
        $product = NULL;
        $temp = 0;
        // role sẽ quy đinh trang thái nút check box
        $role = [
            'show' => 'checked',
            'hide' => ''
        ];
        foreach ($products as $value) {
            $price = currency_format($value['price']);
            $cat = get_cat_by_id($value['cat_id'])['title'];
            $user = get_creator_by_id($value['user_id']);
            $url_update = base_url("?mod=product&action=updateProduct&id={$value['id']}");
            $title = str_limit($value['title'], 20);
            $status = $role[$value['status']];
            $temp++;
            // HTML
            $product .= "<tr>";
            $product .= "<td><span class='tbody-text'> {$temp} </span></td>";
            $product .= "<td><span class='tbody-text'> {$value['code']} </span></td>";
            $product .= "<td>";
            $product .= "<div class='tbody-thumb'>";
            $product .= "<img src=' {$value['thumbnail']} '>";
            $product .= "</div>";
            $product .= "</td>";
            $product .= "<td class='clearfix'><div class='fl-left'>";
            $product .= "<span> {$title} </span></div>";
            $product .= "<ul class='list-operation fl-right'>";
            $product .= "<li><a href=' {$url_update} ' title='Sửa' class='edit'><i class='far fa-edit'></i></i></a></li>";
            $product .= "<li><a href='' title='Xóa' data-id=' {$value['id']} ' class='delete'><i class='fa fa-trash' aria-hidden='true'></i></a></li>";
            $product .= "</ul>";
            $product .= "</td>";
            $product .= "<td><span class='tbody-text'> {$price} </span></td>";
            $product .= "<td><span class='tbody-text'> {$cat} </span></td>";
            $product .= "<td><input type='checkbox' data-id=' {$value['id']} ' class='btn-toggle-status' {$status} ></td>";
            $product .= "<td><span class='tbody-text'> {$user} </span></td>";
            $product .= "<td><span class='tbody-text'> {$value['created_at']} </span></td>";
            $product .= "</tr>";
        }
        $paginate = paginate($num_page, $page);
        $data_send = array(
            'send' => $product,
            'paginate' => $paginate,
        );
        echo json_encode($data_send);
    }
    //   Cổng thi hành checkbox
    if (!empty($_GET['id'])) {
        // quy đổi true false để update
        $role = [
            'true' => 'show',
            'false' => 'hide',
        ];
        $data_update = [
            'status' => $role[$_GET['status']]
        ];
        update_product($data_update, $_GET['id']);
        // return publish pending
        $data_return = [
            'show' => num_status('show'),
            'hide' => num_status('hide')
        ];
        echo json_encode($data_return);
    }
}

function updateProductAction()
{
    $id = intval($_GET['id']);
    if (!empty($id)) {
        global $error, $title, $price, $price_old, $code, $desc, $brand, $origin, $qty, $content, $thumbnail;
        // nhận cat id để set value
        $product = get_product_by_id($id);
        // set value
        $title = $product['title'];
        $price = $product['price'];
        $price_old = $product['price_old'];
        $code = $product['code'];
        $desc = $product['desc'];
        $brand = $product['brand'];
        $origin = $product['origin'];
        $qty = $product['qty'];
        $content = $product['content'];
        $thumbnail = $product['thumbnail'];
        $cat_id = $product['cat_id'];
        // truyền dữ liệu cat qua view
        $cats = data_tree(get_cats());
        $cat = get_cat_by_id($cat_id)['title'];
        $data = [
            'cats' => $cats,
            'cat' => $cat
        ];
        // submit
        if (isset($_POST['btn_add'])) {
            $error = array();
            $product = $_POST;
            //  validition
            // title
            if (empty($_POST['title'])) {
                $error['title'] = "Không được bỏ trống tên sản phẩm";
            } else {
                if (lenght_product($_POST['title'])) {
                    $title = $_POST['title'];
                } else {
                    $error['title'] = "Độ dài tối thiểu lớn 3";
                }
            }
            // code
            if (empty($_POST['code'])) {
                $error['code'] = "Không được bỏ trống mã sản phẩm";
            } else {
                if (lenght_product($_POST['code'])) {
                    $code = $_POST['code'];
                } else {
                    $error['code'] = "Độ dài tối thiểu lớn 3";
                }
            }
            // price
            if (empty($_POST['price'])) {
                $error['price'] = "Không được bỏ trống giá mới sản phẩm";
            } else {
                if (intval($_POST['price']) == 0) {
                    $error['price'] = "Bạn không được phép nhập chữ";
                } else {
                    $price = intval($_POST['price']);
                }
            }
            // price_old
            if (!empty($_POST['price_old'])) {
                if (intval($_POST['price_old']) == 0) {
                    $error['price_old'] = "Bạn không được phép nhập chữ";
                } else {
                    $price_old = intval($_POST['price_old']);
                }
            }
            # brand
            if (empty($_POST['brand'])) {
                $error['brand'] = "Không được bỏ trống Thương Hiệu";
            } else {
                if (lenght_product($_POST['brand'])) {
                    $brand = $_POST['brand'];
                } else {
                    $error['brand'] = "Độ dài tối thiểu lớn 3";
                }
            }
            # origin
            if (empty($_POST['origin'])) {
                $error['origin'] = "Không được bỏ trống Xuất xứ sản phẩm";
            } else {
                if (lenght_product($_POST['origin'])) {
                    $origin = $_POST['origin'];
                } else {
                    $error['origin'] = "Độ dài tối thiểu lớn 3";
                }
            }
            # qty
            if (empty($_POST['qty'])) {
                $error['qty'] = "Không được bỏ trống tổng số lượng sản phẩm ";
            } else {
                if (intval($_POST['qty']) > 0) {
                    $qty = $_POST['qty'];
                } else {
                    $error['qty'] = "Số lượng ít nhất 1";
                }
            }
            # desc
            if (empty($_POST['desc'])) {
                $error['desc'] = "Không được bỏ trống mô tả sản phẩm sản phẩm";
            } else {
                if (lenght_product($_POST['desc'])) {
                    $desc = $_POST['desc'];
                } else {
                    $error['desc'] = "Độ dài tối thiểu lớn 3";
                }
            }
            // content
            if (empty($_POST['content'])) {
                $error['content'] = "Không được bỏ trống nội dung sản phẩm";
            } else {
                if (lenght_product($_POST['content'])) {
                    $content = $_POST['content'];
                } else {
                    $error['content'] = "Độ dài tối thiểu lớn 3";
                }
            }
            // parent_id
            if (empty($_POST['parent_id'])) {
                $error['parent_id'] = "Không được bỏ danh mục sản phẩm";
            } else {
                $cat_id = $_POST['parent_id'];
            }
            // upload
            if (!empty($_FILES['thumbnail']['name'][0]) && empty($error)) {
                $dir_upload = "public/images/products/";
                $product['thumbnail'] = multiple_upload('thumbnail', $dir_upload, $title)[0];
                // xóa ảnh cũ
                if (file_exists($thumbnail)) {
                    unlink($thumbnail);
                }
            }
            if (empty($error)) {
                // chuyển đổi parent id và cat_id
                $product['cat_id'] = $product['parent_id'];
                // xóa trường btn add
                unset($product['btn_add'], $product['parent_id']);
                // update product
                update_product($product, $id);
                // update depots
                $qty = ['qty' => $product['qty']];
                update_depots($qty, $id);
                // chuyển hướng về danh sách trang
                redirect_to("?mod=product&action=listProduct");
            };
        }
    } else {
        redirect_to("?mod=product&action=listProduct");
    }
    load_view('add_product', $data);
}

function deleteProductAction()
{
    /* 
    *   xóa 2 bảng list_page và cat page
    *   xóa ảnh đại diện
    */
    $id = intval($_GET['id']);
    $thumb_page = get_product_by_id($id)['thumbnail'];
    if (file_exists($thumb_page)) {
        unlink($thumb_page);
    }
    delete_product($id);
}
