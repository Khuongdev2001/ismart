<?php
function get_product_by_id($id)
{
    $sql = "SELECT * FROM `products` WHERE `id`={$id}";
    $result = db_fetch_row($sql);
    return $result;
}

function add_order($orders)
{
    db_insert('orders', $orders);
}
