<?php

// # upload ajax
// function uploadAjax()
// {
//     $error = array();
//     $type_accept = array('jpg', 'png', 'gif');
//     $type = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
//     // check định dạng file
//     if (in_array($type, $type_accept)) {
//         // check file size
//         $file_size = $_FILES['upload']['size'];
//         if ($file_size < 21000000) {
//             if (!empty($_SESSION['upload'])) {
//                 // kiểm tra có file trong thư mục tạm thời lần trước không.có xóa
//                 $tmp_upload = $_SESSION['upload']['tmp_upload'];
//                 unlink($tmp_upload);
//             }
//             $dir = "public/tmp_upload/";
//             $upload = $dir . $_FILES['upload']['name'];
//         } else {
//             $error['upload'] = "Kích thức file nhỏ hơn 20MB";
//         }
//     } else {
//         $error['upload'] = "Vui lòng chọn đúng file ảnh";
//     }
//     if (empty($error)) {
//         if (move_uploaded_file($_FILES['upload']['tmp_name'], $upload)) {
//             // tạo sesstion bên submit form xử lý
//             $_SESSION['upload']['tmp_upload'] = $upload;
//             echo $upload;
//         }
//     } else {
//         echo "false";
//     }
// }

// # upload thumb

// function upload_thumb($dir_upload)
// {
//     if (!empty($_SESSION['upload']['tmp_upload'])) {
//         // lấy file cũ nhờ session
//         $tmp_upload = $_SESSION['upload']['tmp_upload'];
//         // tạo đường dẫn mới
//         $file_name = pathinfo($_SESSION['upload']['tmp_upload'], PATHINFO_FILENAME);
//         $type = pathinfo($_SESSION['upload']['tmp_upload'], PATHINFO_EXTENSION);
//         $upload = $dir_upload . $file_name . '.' . $type;
//         //kiểm tra file có tồn tại thu mục
//         if (file_exists($upload)) {
//             // xử lý trùng file
//             $upload = $dir_upload . "$file_name" . '-copy.' . $type;
//             $temp = 0;
//             while (file_exists($upload)) {
//                 $temp++;
//                 $upload = $dir_upload . $file_name . "-copy-{$temp}." . $type;
//             }
//         }
//         if (rename($tmp_upload, $upload)) {
//             unset($_SESSION['upload']);
//             return $upload;
//         }
//     }
//     return false;
// }

function multiple_upload($name, $dir_upload, $data_title = '')
{
    /*
    * $name :name element input file
    * $dir_upload :path folder contain file
    * $data_title : name file upload
    * $id: field id inside tbl_list_product 
    */
    if (!empty($_FILES[$name]['name'][0])) {
        global $error;
        $type_accept = array('JPG', 'PNG', 'GIF', 'JPEG');
        $file_size = $_FILES[$name]['size'];
        $file_name = $_FILES[$name]['name'];
        $tmp = $_FILES[$name]['tmp_name'];
        $insert = array();
        $count = count($_FILES[$name]['name']);
        for ($i = 0; $i < $count; $i++) {
            $type = pathinfo($file_name[$i], PATHINFO_EXTENSION);
            if (in_array(strtoupper($type), $type_accept)) {
                if ($file_size[$i] < 21000000) {
                    $upload_file = $dir_upload . md5($data_title) . "." . $type;
                    $temp = 0;
                    while (file_exists($upload_file)) {
                        $temp++;
                        $upload_file = $dir_upload . md5($data_title) . "_{$temp}." . $type;
                    }
                    // move file
                    if (move_uploaded_file($tmp[$i], $upload_file)) {
                        // slug insert multiple tbl thumb_product
                        $insert[] = $upload_file;
                    }
                } else {
                    $error['file'] = "Kích thước cho phép nhỏ hơn 20MB";
                }
            } else {
                $error['file'] = "Sai định đạng ảnh";
            }
        }
        return $insert;
    }
}
