<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php
        get_sidebar();
        ?>
        <div id="content" class="detail-exhibition fl-right">
            <div class="section" id="info">
                <ul class="list-item row" id='list_info_order'>
                    <li class="col-md-12"><h3 class="section-title">Thông tin đơn hàng</h3></li>
                    <li class="col-md-3">
                        <h3 class="title">Tên khách hàng</h3>
                        <span class="detail"><?php echo $fullname; ?></span>
                    </li>
                    <li class="col-md-3">
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo $code; ?></span>
                    </li>
                    <li class="col-md-3">
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php echo $address; ?></span>
                    </li>
                    <li class="col-md-3">
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail"><?php echo $payment_method;?></span>
                    </li>
                    <li class="col-md-12">
                        <h3 class="title">Ghi chú người nhận</h3>
                        <span class="detail"><?php echo $note; ?></span>
                    </li class="col-md-12">
                    <form method="POST" action="">
                        <?php
                        status_order($status);
                        ?>
                    </form>
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive" id="table_order">
                    <table class="table info-exhibition table-hover">
                        <div id="loading">
                            <span class="spinner-border text-danger spinner-border-sm">
                            </span>
                        </div>
                        <thead class="thead-dark">
                            <tr>
                                <th class="thead-text">STT</th>
                                <th class="thead-text">Ảnh sản phẩm</th>
                                <th class="thead-text">Tên sản phẩm</th>
                                <th class="thead-text">Đơn giá</th>
                                <th class="thead-text">Số lượng</th>
                                <th class="thead-text">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody id="list_data">
                        </tbody>
                    </table>
                    <div id="pagging">

                    </div>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $num_order; ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($total); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
get_footer();
?>
<script>
    $(document).ready(function() {
        get_list_data("?mod=sales&action=detailsOrderProduct");
    })
</script>