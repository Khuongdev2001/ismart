<?php
function info_paginate($total, $page)
{
    $num_per_page = 3;
    $num_page = ceil($total / $num_per_page);
    $start = ($page - 1) * $num_per_page;
    $info_paginate = array(
        'total' => $total,
        'num_page' => $num_page,
        'num_per_page' => $num_per_page,
        'start' => $start
    );
    return $info_paginate;
}

function paginate($num_page, $page = 1)
{
    // khắc phục lỗi mất  get seach khi chuyển trang
    $seach = !empty($_GET['seach']) ? "&seach={$_GET['seach']}" : "";
    if ($num_page > 1) {
        $num_pagging = $num_page > 5 ? 5 : $num_page;
        $temp = 0;
        if ($page > 3) {
            $temp = $page - 3;
        };
        $pagging = "<ul id='list-paging' class='fl-right'>";
        if ($page > 1) {
            $prev = $page - 1;
            $pagging .= "<li><a href='" . "?mod=page&action=listPage&page={$prev}{$seach}" . "' title='' data-action='<'>PREV</a></li>";
        }
        for ($i = 1; $i <= $num_pagging; $i++) {
            $temp++;
            // active trang hiện thời
            $active = "";
            if ($temp == $page) {
                $active = "class='active'";
            }
            $pagging .= "<li><a $active href='" . base_url("?mod=page&action=listPage&page={$temp}{$seach}") . "' title='' data-action='".$temp."'>{$temp}</a></li>";
            if ($temp >= $num_page) {
                break;
            }
        };
        if ($page < $num_page) {
            $next = $page + 1;
            $pagging .= "<li><a href='" . "?mod=page&action=listPage&page={$next}{$seach}" . "' title='' data-action='>'>NEXT</a></li>";
        }
        $pagging .= "</ul>";
        return $pagging;
    }
}