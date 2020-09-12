<?php

function get_list_slider()
{
    $sql = "SELECT `thumbnails` FROM `sliders`";
    $result = db_fetch_row($sql);
    return $result['thumbnails'];
}

function update_slider($sliders)
{
    $where = "`id`> 1";
    db_update('sliders', $sliders, $where);
}
