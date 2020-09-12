<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="public/css/fontawesome/css/all.css" rel="stylesheet" type="text/css" />
    <link href="public/css/style.css" rel="stylesheet" type="text/css" />
    <link href="public/css/responsive.css" rel="stylesheet" type="text/css" />
    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <?php
        spinner_loading();
        ?>
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Trang web dựa trên nên tảng PHP</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id='main-menu' class='clearfix'>
                                <?php if (!is_login()) { ?>
                                    <li><a href='?mod=user&action=login' title='Đăng Nhập'>Đăng Nhập</a></li>
                                    <li><a href='?mod=user&action=reg' title="Đăng Ký">Đăng Ký</a></li>
                                <?php } else { ?>
                                    <li><a href='?mod=user&action=details' title='Đăng Nhập'><?php $user=session_login(); echo $fullname=$user['fullname']; ?></a></li>
                                    <li><a href='?mod=user&action=logout' title='Đăng Ký'>Đăng xuất</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="?page=home" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="GET" action="" id="box-seach">
                                <?php
                                foreach ($_GET as $keyword => $item) {
                                    if ($keyword == "seach")
                                        continue;
                                ?>
                                    <input type="hidden" name="<?php echo $keyword ?>" value="<?php echo $item ?>">
                                <?php
                                }
                                ?>
                                <input type="hidden" name="mod" value="product">
                                <input type="text" name="seach" id="seach" autocomplete="off" placeholder="Nhập từ khóa tìm kiếm tại đây!" value="<?php echo $_GET['seach']??NULL?>">
                                <button type="submit" id="btn-seach">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone" id="call">0394182551</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="<?php echo base_url("?mod=cart&action=showCart"); ?>" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num"><?php echo get_num_order(); ?></span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="<?php echo base_url("?mod=cart&action=showCart"); ?>" class="fa fa-shopping-cart" aria-hidden="true"></a>
                                    <span id="num"><?php echo get_num_order(); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>