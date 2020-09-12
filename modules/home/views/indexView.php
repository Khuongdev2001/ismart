<?php
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    $slider = get_sliders();
                    if (!empty($sliders)) {
                        $temp = 0;
                        foreach ($sliders as $slider) {
                            $temp++;
                    ?>
                            <div class="item">
                                <img src="admin/<?php echo $slider ?>" alt="banner -<?php echo $slider; ?>">
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php
                        $hot_products = get_hot_products();
                        if (!empty($hot_products)) {
                            foreach ($hot_products as $product) {
                        ?>
                                <li>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $product['cat_id']; ?>&slug=<?php echo $product['slug']; ?>" title="" class="thumb">
                                        <img data-src="admin/<?php echo $product['thumbnail'] ?>" class="lazy">
                                    </a>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $product['cat_id']; ?>&slug=<?php echo $product['slug']; ?>" title="" class="product-name"><?php echo $product['title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product['price']); ?></span>
                                        <span class="old"><?php echo currency_format($product['price_old']); ?></span>
                                    </div>
                                    <div class="action clearfix text-center">
                                        <a href="?page=cart" title="Thêm giỏ hàng" data-id="<?php echo $product['id']; ?>" class="add-cart">Thêm giỏ hàng</a>
                                    </div>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <p>Hiện Không có sản phẩm nào</p>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Ngẫu nhiên dành cho bạn</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <?php
                        $products = get_products();
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                $data = get_qty_selled_by_id($product['id']);
                                $qty_selled = $data['qty_selled'];
                                $qty = $data['qty'];
                        ?>
                                <li>
                                    <?php
                                    if (!empty($product['price_old'])) {
                                    ?>
                                        <div class="label-discount">
                                            <span>
                                            <?php
                                            $residual = $product['price_old'] - $product['price'];
                                            // thêm dấu -
                                            echo -floor(($residual / $product['price_old']) * 100);
                                            ?>
                                            %</span>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $product['cat_id']; ?>&slug=<?php echo $product['slug']; ?>" title="" class="thumb">
                                        <img data-src="admin/<?php echo $product['thumbnail']; ?>" class="lazy">
                                    </a>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $product['cat_id']; ?>&slug=<?php echo $product['slug']; ?>" title="" class="product-name"><?php echo $product['title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product['price']); ?></span>
                                        <span class="old"><?php echo currency_format($product['price_old']); ?></span>
                                    </div>
                                    <div class="status_product">
                                        <span class="percent load" style="width:<?php echo ($qty_selled / $qty) * 100 ?>%"></span>
                                        <span class="number">Đã Bán: <?php echo $qty_selled; ?></span>
                                    </div>
                                    <div class="box-star">
                                        <?php
                                        $star = get_star($product['id']);
                                        for ($i = 1; $i <= 5; $i++) {
                                            $active = "";
                                            if ($i <= $star) {
                                                $active = "active";
                                            }
                                        ?>
                                            <i class="fas fa-star <?php echo $active; ?>"></i>
                                        <?php
                                        } 
                                        ?>
                                    </div>
                                    <div class="action clearfix text-center">
                                        <a href="?page=cart" title="Thêm giỏ hàng" data-id="<?php echo $product['id']; ?>" class="add-cart">Thêm giỏ hàng</a>
                                    </div>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li>Hiện Không có sản phẩm nào</li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="box text-center">
                    <a href="?mod=product&cat=all" id="see-more">Xem thêm</a>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Thời Trang</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix" id="product-cat">
                        <?php
                        if (!empty($product_by_cat)) {
                            foreach ($product_by_cat as $item) {
                        ?>
                                <li>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $item['cat_id']; ?>&id=<?php echo $item['product_id']; ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $item['thumb_product']; ?>">
                                    </a>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $item['cat_id']; ?>&id=<?php echo $item['product_id']; ?>" title="" class="product-name"><?php echo $item['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <div class="box-star">
                                        <?php
                                        // Nhận thông số trung bình cộng sao
                                        for ($i = 1; $i <= 5; $i++) {
                                            $active = "";
                                            if ($i <= intval($item['star'])) {
                                                $active = "active";
                                            }
                                        ?>
                                            <i class="fas fa-star <?php echo $active; ?>"></i>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="action clearfix text-center">
                                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart" data-id="<?php echo $item['product_id']; ?>">Thêm giỏ hàng</a>
                                    </div>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li>Hiện Không có sản phẩm nào</li>
                        <?php
                        }
                        ?>
                    </ul>
                    <div class="box text-center">
                        <a href="?mod=product&cat_id=4" id="see-more">Xem thêm</a>
                    </div>
                </div>
            </div>
            <?php
            // danh sách sản phẩm khi được click tối đa 4 sản phẩm 
            $products_visited = get_products_visited();
            if (!empty($products_visited)) {
            ?>
                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm Mà Bạn Đã Xem</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php
                            foreach ($products_visited as $item) {
                            ?>
                                <li>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $item['cat_id']; ?>&slug=<?php echo $item['slug']; ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $item['thumbnail'] ?>">
                                    </a>
                                    <a href="?mod=product&action=details&cat_id=<?php echo $item['cat_id']; ?>&slug=<?php echo $item['slug']; ?>" title="" class="product-name"><?php echo $item['title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']); ?></span>
                                        <span class="old"><?php echo currency_format($item['price_old']); ?></span>
                                    </div>
                                    <div class="action clearfix text-center">
                                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart" data-id="<?php echo $item['id']; ?>">Thêm giỏ hàng</a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        get_sidebar();
        ?>
    </div>
</div>
<?php
get_footer();
?>
<script>
    $(window).scroll(function() {
        if ($(window).scrollTop() >= 1000) {
            $(".status_product .percent").removeClass("load");
        }
    })
</script>