<?php

function show_array($data)
{
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

function empty_val($data)
{
    if (empty($data)) {
        return "";
    }
    return $data;
}

function avg($total, $star)
{
    $avg = 0;
    if ($total != 0)
        $avg = ($star / $total) * 100;
    return $avg;
}
