<?php
// Hiển thị mảng
function show_array($data)
{
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

// Chuyển đổi slug
function slug($object)
{
    // convert string lowercase    
    $object = strtolower($object);
    //    Hàm chuyển đổi slug
    $str_seach = "đ-ô-ố-ồ-ộ-ổ-ỗ-ó-ò-ỏ-õ-ọ-é-è-ẹ-ẽ-ẻ-ă-â-á-à-ạ-à-ả-ã-ắ-ằ-ặ-à-ắ-ẵ-ẳ-ầ-ấ-ẫ-ẩ-ậ-ú-ù-ủ-ũ-ụ-ư-ứ-ừ-ự-ữ-ử-ê-ế-ề-ệ-ễ-ể-ì-í-ị-ỉ-ĩ-ỳ-ý-ỵ-ỹ-ỷ-ơ-ớ-ờ-ớ-ợ-ỡ-ở- -/-!-@-#--$-%-^-&-*-(-)-_-+-|-\-?-<->-.-,-'";
    $str_replace = "d o o o o o o o o o o o e e e e e a a a a a a a a a a a a a a a a a a a a u u u u u u u u u u u e e e e e e i i i i i y y y y y o o o o o o o -";
    $seach = explode("-", $str_seach);
    $replace = explode(" ", $str_replace);
    return str_replace($seach, $replace, $object);
}