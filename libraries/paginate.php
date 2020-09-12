<?php

// function get list data ajax

function info_paginate($total,$page=1)
{
    $num_per_page = 10;
    $num_page = ceil($total / $num_per_page);
    $start = ($page - 1) * $num_per_page;
    $data = array(
        'total' => $total,
        'num_per_page' => $num_per_page,
        'num_page' => $num_page,
        'start' => $start
    );
    return $data;
}



function paginate($number_page, $page = "")
{
    // khắc phục lỗi mất  get seach khi chuyển trang
    $url = "?";
    foreach ($_GET as $key_word => $item) {
        if ($key_word == 'price')
            break;
        if ($key_word == 'page')
            continue;
        $url .= "{$key_word}={$item}&";
    }
    $page = !empty($_GET['page']) ? $_GET['page'] : 1;
    if ($number_page > 1) {
        $number_pagging = $number_page > 5 ? 5 : $number_page;
        $temp = 0;
        if ($page > 3) {
            $temp = $page - 3;
        };
        $pagging = "<ul id='list-paging' class='fl-right'>";
        if ($page > 1) {
            $prev = $page - 1;
            $pagging .= "<li><a href='" . $url . "' title='' data-action='<'>PREV</a></li>";
        }
        for ($i = 1; $i <= $number_pagging; $i++) {
            $temp++;
            // active trang hiện thời
            $active = "";
            if ($temp == $page) {
                $active = "class='active'";
            }
            $pagging .= "<li><a $active href='" . base_url("{$url}page={$temp}") . "' title='' data-action='" . $temp . "'>{$temp}</a></li>";
            if ($temp >= $number_page) {
                break;
            }
        };
        if ($page < $number_page) {
            $next = $page + 1;
            $pagging .= "<li><a href='" . $url . "' title='' data-action='>'>NEXT</a></li>";
        }
        $pagging .= "</ul>";
        return $pagging;
    }
}
