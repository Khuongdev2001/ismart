<?php
function popup_delete($title, $content)
{
?>
    <div id="popup-delete" class="p-4 position-fixed w-100">
        <div class="popup-bg">
        </div>
        <div class="popup-dialog">
            <div class="poup-header bg-danger p-2 text-light">
                <h2 class="font-weight-bold"><?php echo $title ?></h2>
            </div>
            <div class="popup-content">
                <p><?php echo $content ?></p>
            </div>
            <div class="popup-footer text-right">
                <button class="btn-back btn btn-outline-info btn-sm">Quay về</button>
                <button class="btn-accept btn btn-outline-danger btn-sm">Đồng ý</button>
            </div>
        </div>
    </div>
<?php
}

// active sidebar 
function active_sidebar($url)
{
    $act = !empty($_GET['action']) ? $_GET['action'] : "";
    if ($url == $act) {
        $act = "class='active_sidebar'";
        return $act;
    }
    return NULL;
}

// EFFECT LOADDING
function spinner_loading()
{
?>
    <div id="loading">
        <span id="spinner-loading">
        </span>
        <div id="inner-loading">
            <img src="public\images\load\spiner-loading.jpeg">
        </div>
    </div>
<?php
}

function nav_status($total, $show, $hide)
{
?>
    <ul class="post-status fl-left clearfix text-light">
        <li class="all">Tất cả:
            <span class="count">
                <?php echo $total ?>
            </span>
        </li>
        <li class="show">Công khai:
            <span class="count">
                <?php echo $show ?>
            </span>
        </li>
        <li class="hiden">Chờ duyệt:
            <span class="count">
                <?php echo $hide ?>
            </span>
        </li>       
    </ul>
<?php
}

// show option status customer order : đang xử lý đã giao hàng
function status_order($status)
{
    $list_status=['pending'=>'Đang xử lý','received'=>'Đã tiếp nhận','success'=>'Thành công','cancel'=>'Bị hủy'];
    $info = "<li>";
    $info .= "<h3 class='title'>Tình trạng đơn hàng</h3><select name='status'>";
    foreach ($list_status as $key=>$value) {
        $active = NULL;
        if ($status == $key)
            $active = "selected";
        $info .= "<option value='{$key}'{$active}> {$value} </option>";
    }
    $info .= "</select><input type='submit' name='btn_update' value='Cập nhật'></li>";
    echo $info;
}



// get table list customer 

function get_table_product()
{
?>
    <table class="table list-table-wp table-hover">
        <thead class="thead-dark">
            <tr>
                <th><span class="thead-text">STT</span></th>
                <th><span class="thead-text">code</span></th>
                <th><span class="thead-text">ảnh</span></th>
                <th><span class="thead-text">Tên sản phẩm</span></th>
                <th><span class="thead-text">Giá</span></th>
                <th><span class="thead-text">Danh mục</span></th>
                <th><span class="thead-text">Trạng thái</span></th>
                <th><span class="thead-text">Người tạo</span></th>
                <th><span class="thead-text">Thời gian</span></th>
            </tr>
        </thead>
        <tbody id="list_data">
        </tbody>
    </table>
<?php
}
// modal delete
function model()
{
?>
    <div class="modal fade" id="active-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Thông báo</h2>
                    <button class="close" data-dismiss="modal">
                        <span>X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong class="text-danger d-block">bạn muốn xóa bài viết với tiêu đề</strong>
                    <small class="post_title">Trung quốc</small>
                    <strong class="d-block">Việc xóa sẽ không phục hồi được nhé</strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" id="delete_active" data-dismiss="modal">Xóa</button>
                    <button class="btn btn-info btn-sm" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
/***
 * 
 * Khi cập nhật cat phần cat_parent và title mới có giá trị
 *  
 * Việc truyền giá trị để tránh hiển thị chính nó
 */

function get_cat_parents($cat, $cat_parent = "", $cats)
{
    $title = empty($cat) ? '' : $cat['title'];
    if (!empty($cats)) {
        $data = "<select name='parent_id' class='form-control w-auto' ><option value=''>-- Chọn danh mục --</option>";
        if (!empty($cats)) {
            foreach ($cats as $value) {
                if ($value['title'] == $title)
                    continue;
                $select = "";
                if ($value['title'] == $cat_parent)
                    $select = "selected";
                $data .= " <option value=' {$value['id']} '{$select}>" . str_repeat('--', $value['level']) . $value['title'] . "</option>";
            }
        }
        $data .= "</select>";
        return $data;
    }
}

/*
 * hàm có 2 trạng thái nếu có id lấy ảnh theo id
 * ngược lại hiển thị khung
*/
function show_slider()
{
    // nếu có  id để hiển thị thì bỏ display:none 
    $none = !empty($_GET['product_id']) ? NULL : "d-none";
    $data = "<ul class='sider d-flex box-preview align-items-center {$none}'><li class='rec-preview border-success' id='prev'><i class='fas fa-chevron-left'></i></li>";
    $id = !empty($_GET['product_id']) ? $_GET['product_id'] : "";
    if (!empty($id)) {
        $list_slider = get_slider_product_by_id($id);
        foreach ($list_slider as $value) {
            $data .= "<li class='img_slider_preview' data-id=' {$value['thumb_id']} '><span class='btn-delete-slider'><i class='fas fa-times'></i></span><img src='{$value['thumb_product']}' alt='" . $value['thumb_id'] . "'></li>";
        }
    };
    $data .= "<li class='rec-preview' id='next'><i class='fas fa-chevron-right'></i></li></ul>";
    return $data;
}

?>