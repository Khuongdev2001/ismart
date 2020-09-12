<?php
// get list cat return array
function get_cats()
{
    $sql = "SELECT * FROM `cat_products`";
    $result = db_fetch_array($sql);
    return $result;
}
// get all product type show return array
function get_products()
{
    $sql = "SELECT * FROM `products` WHERE `status`='show' ORDER BY RAND() LIMIT 12";
    $result = db_fetch_array($sql);
    return $result;
}
// get product type hot_product return array
function get_hot_products()
{
    $sql = "SELECT * FROM `products` WHERE `status`='show' AND `type`='hot_product' LIMIT 8";
    $result = db_fetch_array($sql);
    return $result;
}
// get product type sale product retrn array
function get_flash_sale_products()
{
    $sql = "SELECT * FROM `products` WHERE `status`='show' AND `type`='flash_sale' ORDER BY RAND() LIMIT 4";
    $result = db_fetch_array($sql);
    return $result;
}
// get product just click variable session return session
function get_products_visited()
{
    // dang array
    if (!empty($_SESSION['product_visited'])) {
        $ids = $_SESSION['product_visited'];
        // dạng string
        $ids = implode(',', $ids);
        $sql = "SELECT * FROM `products` WHERE `id` IN({$ids}) AND `status`='show'";
        $result = db_fetch_array($sql);
        return $result;
    }
    return false;
}
// get cat by id return array
function get_cat_by_id($id)
{
    $sql = "SELECT * FROM `cat_products` WHERE `id`={$id}";
    $result = db_fetch_row($sql);
    return $result;
}
// get qty sell by id return array
function get_qty_selled_by_id($id)
{
    $sql = "SELECT * FROM `depots` WHERE `product_id`='{$id}'";
    $result = db_fetch_row($sql);
    return $result;
}


function get_star($id)
{
    $sql = "SELECT AVG(`stars`) AS `stars` FROM `comments` WHERE `product_id`={$id}";
    $result = db_fetch_row($sql);
    return $result['stars'];
}

function get_sliders()
{
    $sql = "SELECT * FROM `sliders`";
    $result = db_fetch_row($sql);
    return $result['thumbnails'];
}
