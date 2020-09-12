<?php
get_header();
?>
<form action="" method="post">
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <?php echo form_error("fullname"); ?>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value("fullname"); ?>">
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <?php echo form_error("email"); ?>
                            <input type="email" name="email" id="email" value="<?php echo set_value("email"); ?>">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <?php echo form_error("address"); ?>
                            <input type="text" name="address" id="address" value="<?php echo set_value("address"); ?>">
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <?php echo form_error("phone"); ?>
                            <input type="tel" name="phone" id="phone" value="<?php echo set_value("phone"); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"><?php echo set_value("note"); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($carts)) {
                                foreach ($carts as $cart) {
                            ?>
                                <tr class="cart-item">
                                    <td class="product-name"><?php echo $cart['title']; ?><strong class="product-quantity">x <?php echo $cart['qty']; ?></strong></td>
                                    <td class="product-total"><?php echo currency_format($cart['sub_total']); ?></td>
                                </tr>
                            <?php
                                }}
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php if (!empty($total)) echo currency_format($total); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <?php echo form_error("payment_method"); ?>
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment_method" value="direct_payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment_method" value="payment_home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng" name="btn_checkout">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
get_footer();
?>