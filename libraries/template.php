<?php
// GET LIST MENU

function get_list_menu()
{
    $data_menu_db = get_menu_db();
    // ghép mảng lại với nhau
    $menu = "";
    foreach ($data_menu_db as $item) {
        $menu .= "<li><a href='" . $item['link'] . "' title=''>" . $item['menu_title'] . "</a></li>";
    }
    return $menu;
}


// GET CATEROGY PRODUCT    
function menu_multi($parent_id = 0, $active = "list-item")
{
    $cats = get_cats();
    $menu = "<ul class='{$active}'>";
    foreach ($cats as $cat) {
        if ($cat['parent_id'] == $parent_id) {
            $check = true;
            $menu .= "<li><a href='?mod=product&slug={$cat['slug']}' title=''>{$cat['title']}</a>";
            unset($cats[$cat['id'] - 1]);
            $sub_menu = menu_multi($cat['id'], "sub-menu");
            $menu .= "{$sub_menu}</li>";
        }
    }
    //  KIỂM TRA VÌ CÓ TRƯỜNG HỢP KHÔNG CÒN NỮA MÀ NÓ VẪN CHẠY HÀM NÊN DƯ UL 
    //  KIỂM TRA NẾU CÓ LẮP TỨC CÒN THÌ NHƯ CŨ NGƯỢC LẠI RESET BIẾN ĐÓ
    if (isset($check)) {
        $menu .= "</ul>";
        return $menu;
    }
    return "";
}


function get_comments($comments, $parent_id = 0)
{
    foreach ($comments as $key => $comment) {
        //    Chú thích nếu parent_id =0 tứng là khách comment => list
        if ($parent_id == $comment['parent_id']) {
            $class = "sub_comment";
            // get name user
            $user=get_user_by_id($comment['user_id']);
            // get role user
            $role=get_role_by_id($comment['user_id']);
            if ($parent_id == 0)
                $class = "list-comment reply";
?>
    <ul class="<?php echo $class; ?>">
        <li class="comment">
            <a data-parent=<?php echo $comment['id']; ?> data-product=<?php echo $comment['product_id']; ?> class="btn-write"><i class=""></i></a>
            <a class="avatar"><img src="admin/<?php echo $user['thumbnail']; ?>"></a>
            <div class="box-content">
                <h3 class="comment-author"><?php echo $user['fullname']; ?> <span class="label"><?php  echo $role; ?></span></h3>
                <span class="date-post"><?php echo $comment['created_at']; ?></span>
                <p class="content-comment">
                    <?php echo $comment['content']; ?>
                </p>
                <?php
                // Vì lấy product id ngẫu nhiễn nên không nào unset thông qua comment id mà phải dùng biến temp
                unset($comments[$key]);
                get_comments($comments, $comment['id']);
                ?>
            </div>
        </li>
    </ul>
    <?php
    }}
}

// Loading
function spinner_loading()
{
    ?>
    <div id="loading">
        <span id="spinner-loading"></span>
        <div id="inner-loading">
            <img src="public\images\loadding\loading.png">
        </div>
    </div>
<?php
}

// save product Recently
function product_visited($id)
{
    if (!empty($_SESSION['product_visited'])) {
        $temp = count($_SESSION['product_visited']);
        if ($temp > 3) {
            unset($_SESSION['product_visited']);
        }
    }
    //add sesstion
    $_SESSION['product_visited'][$id] = $id;
}
?>