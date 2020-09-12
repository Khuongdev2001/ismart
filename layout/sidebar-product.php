<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php echo menu_multi(); ?>
        </div>
    </div>
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Bộ lọc</h3>
        </div>
        <div class="section-detail">
            <table class="filter-product">
                <thead>
                    <tr>
                        <td colspan="2">Giá</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="radio" class="filter-star fillter" id="5" name="r-price"></td>
                        <td>
                            <label class="box-star" for="5" data-star="5">
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                (5 sao)
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="radio" class="filter-star fillter" id="4" name="r-price"></td>
                        <td>
                            <label class="box-star" for="4" data-star="4">
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star"></i>
                                (4 sao)
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="radio" class="filter-star fillter" name="r-price" id="3"></td>
                        <td>
                            <label class="box-star" for="3" data-star="3">
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                (3 sao)
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="filter-product">
                <thead>
                    <tr>
                        <td colspan="2">Hãng</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($brands)) {
                        foreach ($brands as $brands) {
                    ?>
                            <tr class="box-brand">
                                <td><input type="radio" id="<?php echo $brands['brand']; ?>" name="r-brand" class="r-brand filter-brand fillter"></td>
                                <td class="brand"><label for="<?php echo $brands['brand']; ?>"><?php echo $brands['brand']; ?></label></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <table class="filter-product">
                <thead>
                    <tr>
                        <td colspan="3">Khoảng giá</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="number" name="low-price" min="0" id="low-price" placeholder="Tối Thiểu" class="filter">
                            <span>-</span>
                            <input type="number" name="upper-price" min="1" id="upper-price" placeholder="Tối đa" class="filter">
                            <button id="btn-apply">Áp dụng</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {  
        let click = 0;
        $(".fillter").click(function() {
            click++;
            if (click % 2 == 0) {
                $(this).prop('checked', false);
            }

        })
    })
</script>