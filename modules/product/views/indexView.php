<?php
get_header();
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $cat_title; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $cat_title; ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select" id="order_by">
                                    <option value="">Sắp xếp</option>
                                    <option value="DESC">Giá cao xuống thấp</option>
                                    <option value="ASC">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix" id="list_data">

                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail" id="pagging">
                </div>
            </div>
        </div>
        <?php
        get_sidebar('product');
        ?>
    </div>
</div>
<?php
get_footer();
?>
<script>
    $(document).ready(function() {
        setTimeout(function(){
            get_list_data("?mod=product&action=getListProduct")
        },1000);
    })
</script>