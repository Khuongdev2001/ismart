<?php
function get_num_post()
{
    $sql = "SELECT COUNT(`id`) as `total` FROM `posts`";
    $result = db_fetch_row($sql);
    return $result['total'];
}

function get_num_product()
{
    $sql = "SELECT COUNT(`id`) as `total`FROM `products`";
    $result = db_fetch_row($sql);
    return $result['total'];
}

function get_num_order()
{
    $sql = "SELECT COUNT(`id`) as `total`FROM `orders`";
    $result = db_fetch_row($sql);
    return $result['total'];
}

function get_num_user()
{
    $sql = "SELECT COUNT(`id`) as `total`FROM `users`";
    $result = db_fetch_row($sql);
    return $result['total'];
}
