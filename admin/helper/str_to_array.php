<?php
function str_to_array($str)
{
    $data = json_decode($str);
    // nếu nó là mảng in ra lun
    if (is_array($data))
        return $data;
    $medial = [];
    foreach ($data as $key=>$item) {
        $medial[$key] = $item;
    }
    return $medial;
}