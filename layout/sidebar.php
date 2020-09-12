<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php  echo menu_multi(); ?>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">flash sale</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                <?php
                if (!empty($flash_sale)) {
                    foreach ($flash_sale as $product) {
                ?>
                        <li class="clearfix">
                            <div class="label-discount">
                                Hot Sell
                            </div>
                            <a href="?mod=product&action=details&cat_id=<?php echo $product['cat_id']; ?>&id=<?php echo $product['id']; ?>" title="" class="thumb hot-sell">
                                <img src="admin/<?php echo $product['thumbnail'] ?>">
                            </a>
                            <div class="info">
                                <a href="?mod=product&action=details&cat_id=<?php echo $product['cat_id']; ?>&id=<?php echo $product['id']; ?>" title="" class="product-name"><?php echo $product['title']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($product['price']); ?></span>
                                    <span class="old"><?php echo currency_format($product['price_old']); ?></span>
                                </div>
                            </div>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>