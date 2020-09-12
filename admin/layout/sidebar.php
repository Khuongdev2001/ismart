<?php
$user = session_login();
?>
<div id="sidebar" class="fl-left hidden sticky-top ">
    <div id="box_info_account" class="">
        <div class="d-flex flex-column align-items-center">
            <h2 id="account" class="text-dark"><?php echo $user['fullname']; ?></h2>
            <img src="<?php echo $user['thumbnail']; ?>" id="thumb-circle">
        </div>
        <ul class="d-flex justify-content-center my-3">
            <li class="mx-4"><a class="info-account text-light p-2 bg-info rounded" href="<?php echo base_url("?mod=user&action=update"); ?>" title="Thông tin cá nhân"><i class="fas fa-user-circle"></i></a></li>
            <li class="mx-4"><a class="exit-account text-light p-2 bg-danger rounded" href="<?php echo base_url("?mod=user&action=logout") ?>" title="Thoát"><i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>
    <ul id="sidebar-menu" class="my-3">
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="far fa-file-word"></i>
                <span class="title">Trang</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=page&action=addPage"); ?>" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=page&action=listPage") ?>" title="" class="nav-link">Danh sách các trang</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="far fa-address-card"></i>
                <span class="title">Bài viết</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=post&action=addPost"); ?>" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=post"); ?>" title="" class="nav-link">Danh sách bài viết</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=post&action=listCat"); ?>" title="" class="nav-link">Danh mục bài viết</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <i class="fab fa-product-hunt"></i>
                <span class="title">Sản phẩm</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=product&action=addProduct"); ?>" title="" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=product&action=listProduct"); ?>" title="" class="nav-link">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=product&action=listCat"); ?>" title="" class="nav-link">Danh mục sản phẩm</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-database icon"></span>
                <span class="title">Bán hàng</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=sales&action=index"); ?>" title="" class="nav-link">Danh sách Khách Hàng</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=sales&action=listOrder") ?>" title="" class="nav-link">Danh sách Đơn Hàng</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <i class="fas fa-sliders-h"></i>
                <span class="title">Slider</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="<?php echo base_url("?mod=slider"); ?>" title="" class="nav-link">Thêm mới</a>
                </li>
            </ul>
        </li>
    </ul>
</div>