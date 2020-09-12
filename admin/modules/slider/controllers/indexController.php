<?php
function construct()
{
    load_model('index');
}

function indexaction()
{
    if (isset($_POST['btn-add'])) {
        global $error;
        $error = [];
        if (!empty($_FILES['thumbnail']['name'][0])) {
            $dir_upload = "public/images/sliders/";
            // lây slider đã chuyển đổi cho dù là object string điều thành mảng
            $sliders = str_to_array(get_list_slider());
            $data = multiple_upload('thumbnail', $dir_upload, 'slider');
            // kiểm tra nếu mảng k rỗng mới nối thêm
            if (!empty($sliders)) {
                $data = array_merge($sliders, $data);
            }
            update_slider(['thumbnails' => json_encode($data)]);
            redirect_to("?mod=slider");
        } else {
            $error['upload'] = "Bạn chưa upload ảnh";
        }
    }
    $sliders = json_decode(get_list_slider());
    $data = [
        'sliders' => $sliders
    ];
    load_view('index', $data);
}

function deleteAction()
{
    // nếu k có hàm này sẽ sinh ra dạng object sau lần xóa thứ 2 dẫn đến lện xóa k dc với mảng
    $sliders = str_to_array(get_list_slider());
    // delete db
    $id = intval($_GET['id']);
    // xóa ảnh
    if (file_exists($sliders[$id]))
        unlink($sliders[$id]);
    // xóa trường
    unset($sliders[$id]);
    update_slider(['thumbnails' => json_encode($sliders)]);
    redirect_to("?mod=slider");
}
