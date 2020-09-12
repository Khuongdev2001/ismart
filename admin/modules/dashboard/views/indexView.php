<?php
get_header();
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="box-dashboard" class="no-gutters">
            <div id="post" class="card">
                <div class="card-header">Bài viết</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $number_post; ?></h5>
                </div>
                <a class="detail" href="<?php echo base_url("?mod=post"); ?>">Xem chi tiết</a>
            </div>
            <div id="product" class="card">
                <div class="card-header">Sản phẩm</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $number_product; ?></h5>
                </div>
                <a class="detail" href="<?php echo base_url("?mod=product"); ?>">Xem chi tiết</a>
            </div>
            <div id="sale" class="card">
                <div class="card-header">Số đơn hàng</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $number_order; ?></h5>
                </div>
                <a class="detail" href="<?php echo base_url("?mod=sales"); ?>">Xem chi tiết</a>
            </div>
            <div id="customer" class="card">
                <div class="card-header">Khách hàng</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $number_user; ?></h5>
                </div>
                <a class="detail" href="<?php echo base_url("?mod=sales"); ?>">Xem chi tiết</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>