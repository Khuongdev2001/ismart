<?php
get_header();
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?mod=product&cat_id=<?php echo $product['cat_id']; ?>" title=""><?php echo get_cat_by_id($product['cat_id']); ?></a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $product['title']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb" class="box-zoom">
                            <img id="img" src="admin/<?php echo $product['thumbnail']; ?>" data-zoom-image="admin/<?php echo $product['thumbnail']; ?>" />
                            <div id="lens">
                            </div>
                        </a>
                        <div id="result">

                        </div>
                        <div id="list-thumb">
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="admin/<?php echo $product['thumbnail']; ?>" alt="<?php echo $product['title']; ?>">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product['title']; ?></h3>
                        <div id="box-star">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $active = '';
                                if ($i <= intval($product['stars']))
                                    $active = 'active';
                            ?>
                                <i class='fas fa-star <?php echo $active ?>'></i>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="code">
                            <span class="title">Mã sản phẩm:</span>
                            <?php
                            echo $product['code'];
                            ?>
                        </div>
                        <div class="brand">
                            <span class="title">Thương hiệu:</span>
                            <?php
                            echo $product['brand'];
                            ?>
                        </div>
                        <div class="brand">
                            <span class="title">Xuất xứ:</span>
                            <?php
                            echo $product['origin'];
                            ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">
                                <?php
                                $status = "Hết hàng";
                                // get qty and qty_selled of product (array)
                                $data_qty = get_qty_selled_by_id($product['id']);
                                $qty = $data_qty['qty'];
                                // check status
                                $qty_selled = $data_qty['qty_selled'];
                                if ($qty > $qty_selled)
                                    $status = "Còn hàng";
                                echo $status;
                                ?>
                            </span>
                        </div>
                        <div class="box add">
                            <span class="price-new price"><?php echo currency_format($product['price']); ?></span>
                            <del class="price-old"><?php echo currency_format($product['price_old']); ?></del>
                            <div id="num-order-wp" class="row my-3">
                                <div class="num-order col-md-4">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <div class="col-md-8">
                                    <a href="?page=cart" title="Thêm giỏ hàng" data-id="<?php echo $product['id']; ?>" class="add-cart">Thêm giỏ hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="desc clearfix">
                    <h3 class="section-title">Mô tả ngắn:</h3>
                    <div class="section-detail">
                        <?php
                        echo $product['desc'];
                        ?>
                    </div>
                </div>
            </div>

            <div class="section shorten" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Chi tiết sản phẩm:</h3>
                </div>
                <div class="section-detail">
                    <div class="box-content">
                        <?php
                        echo $product['content'];
                        ?>
                    </div>
                    <div class="text-center">
                        <button id="see-more">Xem thêm</button>
                    </div>
                </div>
            </div>
            <div class="section" id="box-comment">
                <div class="section-head">
                    <h3 class="section-title">Nhận xét của khách hàng</h3>
                </div>
                <div class="box section-detail">
                    <ul id="score-detail" class="row">
                        <li id="rating" class="col-md-4 text-center">
                            <h4 class="title">Điểm Sản Phẩm</h4>
                            <p class="num_score"><?php echo floatval($score['avg']); ?><span class="total_score">/5</span></p>
                            <div id="num_star">

                            </div>
                        </li>
                        <li id="star-process" class="col-md-4">
                            <ul class="status_product">
                                <li data-star=5><span class="percent load five" style='width:<?php echo avg($score['total'], $score['five']); ?>%'></span></li>
                                <li data-star=4><span class="percent load four" style='width:<?php echo avg($score['total'], $score['four']); ?>%'></span></li>
                                <li data-star=3><span class="percent load three" style='width:<?php echo avg($score['total'], $score['three']); ?>%'></span></li>
                                <li data-star=2><span class="percent load two" style='width:<?php echo avg($score['total'], $score['two']); ?>%'></span></li>
                                <li data-star=2><span class="percent load one" style='width:<?php echo avg($score['total'], $score['one']); ?>%'></span></li>
                            </ul>
                        </li>
                        <li id="add-comment" class="col-md-4">
                            <form action="" method="post" class="my-2">
                                <h4 class="title">Chia sẻ trải nghiệm của bạn</h4>
                                <div class="box-option">
                                    <!-- very good -->
                                    <label for="very-good"> Rất tốt</label>
                                    <input type="radio" name="score" id="very-good" value="5">
                                    <!-- good -->
                                    <label for="good"> Tốt</label>
                                    <input type="radio" name="score" id="good" value="4">
                                    <!-- not-good -->
                                    <label for="not-good"> Chưa ok</label>
                                    <input type="radio" name="score" id="not-good" value="3">
                                    <!-- bad -->
                                    <label for="bad"> tệ </label>
                                    <input type="radio" name="score" id="bad" value="2">
                                    <!-- bad-good -->
                                    <label for="very-bad"> rất tệ</label>
                                    <input type="radio" name="score" id="very-bad" value="1">
                                    <?php echo form_error("score"); ?>
                                </div>
                                <div class="form-group my-2">
                                    <label for="content" class="my-2">2.Nhập nội dung comment:*</label>
                                    <textarea id="content" name="content" class="form-control" placeholder="Cảm nghĩ của bạn về sản phẩm"></textarea>
                                    <?php echo form_error("content"); ?>
                                </div>
                                <?php echo form_error("comment"); ?>
                                <button id="btn-post" class="btn btn-sm" name="btn-post">Đăng Bình luận</button>
                            </form>
                        </li>
                    </ul>
                    <?php
                    get_comments($coments);
                    ?>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        if (!empty($products_same)) {
                            foreach ($products_same as $product) {
                                $data_qty = get_qty_selled_by_id($product['id']);
                                $qty = $data_qty['qty'];
                                $qty_selled = $data_qty['qty_selled'];
                        ?>
                                <li>
                                    <a href="<?php echo basename("?mod=product&action=details&cat_id={$product['cat_id']}&slug={$product['slug']}"); ?>" class="thumb">
                                        <img src="admin/<?php echo $product['thumbnail']; ?>">
                                    </a>
                                    <a href="<?php echo basename("?mod=product&action=details&cat_id={$product['cat_id']}&slug={$product['slug']}"); ?>" class="product-name"><?php echo $product['title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product['price']); ?></span>
                                        <span class="old"><?php echo currency_format($product['price_old']); ?></span>
                                    </div>
                                    <div class="status_product">
                                        <span class="percent load" style="width:<?php echo ($qty_selled / $qty) * 100 ?>%"></span>
                                        <span class="number">Đã Bán: <?php echo $qty_selled; ?></span>
                                    </div>
                                    <div class="action clearfix text-center">
                                        <a href="" class="add-cart" data-id="<?php echo $product['id']; ?>">Thêm giỏ hàng</a>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        get_sidebar();
        ?>
    </div>
</div>
<?php
get_footer();
?>
<!-- reply comment -->
<div class="modal" id="modal-comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trả lời bình luận</h5>
                <button type="button" class="exit btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a class="to">@<span></span></a>
                <div class="box-content">
                    <textarea class="w-100 border-0 content" cols="30" rows="5" placeholder="Nhập nội dung trả lời"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" class="float-right btn-reply btn-sm btn-outline-success">Trả lời</a>
                <button type="button" class="exit btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="public\js\zoom.js"></script>
<script>
    $(document).ready(function() {
        // hiển thị chi tiết sản phẩm rút gọn hay toàn phần
        $("#see-more").click(function() {
            $("#post-product-wp").toggleClass("shorten");
            let content_btn = ['Thu nhỏ', 'Xem Thêm'],
                data = $("#post-product-wp").hasClass("shorten");
            $(this).text(content_btn[Number(data)])
        })
        // loại bỏ sub menu k theo icon
        $(".reply>.comment>.btn-write>i").addClass("fas fa-pencil-alt");
        // action slider
        $(".reply>.comment>.btn-write,.exit").click(function() {
            $('#modal-comment').slideToggle(200);
            let name = $(this).parent(".comment").find(">.box-content>.comment-author").text();
            $("#modal-comment .to span").text(name);
            $("body").toggleClass('overflow-hidden');
            let id = $(this).attr("data-product")
            parent_id = $(this).attr("data-parent");
            reply_comment(parent_id, id);
        })
        // zoom();
        $("#main-thumb").mousemove(function(e) {
            console.log(e.pageX);
            return false;
        })
    })
</script>