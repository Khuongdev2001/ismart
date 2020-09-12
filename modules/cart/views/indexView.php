<?php
get_header();
spinner_loading();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Danh sách đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Thứ tự</td>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($carts)) {
                            $temp = 0;
                            foreach ($carts as $cart) {
                                $temp++;
                        ?>
                                <tr>
                                    <td class="temp"><?php echo $temp; ?></td>
                                    <td><?php echo $cart['code']; ?></td>
                                    <td>
                                        <a href="" title="" class="thumb">
                                            <img src="admin/<?php echo $cart['thumbnail']; ?>">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="box">
                                            <a href="?mod=product&action=details&id=<?php echo $cart['id']; ?>&cat_id=<?php echo $cart['cat_id']; ?>" class="name-product"><?php echo $cart['title']; ?></a>
                                        </div>
                                    </td>
                                    <td><?php echo currency_format($cart['price']); ?></td>
                                    <td>
                                        <button class="tbl-plus"><i class="fas fa-plus"></i></button>
                                        <input type="text" name="num-order" min="1" value="<?php echo $cart['qty']; ?>" class="num-order" data-id="<?php echo $cart['id']; ?>">
                                        <button class="tbl-minus"><i class="fas fa-minus"></i></button>
                                    </td>
                                    <td><span data-id="<?php echo $cart['id']; ?>"><?php echo currency_format($cart['qty'] * $cart['price']); ?></span></td>
                                    <td>
                                        <a href="?mod=cart&action=delete&id=<?php echo $cart['id']; ?>" title="" class="del-product"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }} else
                            {
                            ?>
                            <p class="notification">Hiện không có sản phẩm nào trong giỏ hàng của bạn</p>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total" class="fl-right">Tổng giá: <span><?php if (!empty($info)) {echo  currency_format($info['total']);} ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <a href="?mod=cart&action=checkout" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?mod=home" title="" id="buy-more">Mua tiếp</a><br />
                <a href="?mod=cart&action=delete" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<?php
get_footer()
?>
<script>
    $(document).ready(function() {
        change_order();
    })
</script>