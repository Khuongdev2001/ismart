<?php
get_header();
?>
<div id="wp-wrapper">
    <div id="wrapper">
        <div id="top-wrapper" class="row no-gutters">
            <h2 class="section-title col-md-8">Chào mừng đến với Ismart. Đăng nhập ngày!</h2>
            <p class="reg col-md-4">Thành viên mới?<a href="<?php echo base_url("?mod=user&action=reg"); ?>">Đăng ký</a>tại đây</p>
        </div>
        <div id="body-wrapper" class="row">
            <form action="" id="form-login" method="POST" class="col-6">
                <div class="form-group">
                    <label for="username">Tài khoản*</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value("username"); ?>" placeholder="Vui lòng nhập tài khoản của bạn">
                    <?php echo form_error("username"); ?>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu*</label>
                    <input type="password" name="password" id="password" class="form-control" value="" placeholder="Vui lòng nhập mật khẩu">
                    <?php echo form_error("password"); ?>
                </div>
                <?php echo form_error("login"); ?>
                <button class="btn-login" name="btn_login">Đăng nhập</button>
                <a href="" class="forget float-right">Quên mật khẩu</a>
            </form>
            <div id="box-option-login" class="col-md-6">
                <h3>Hoặc đăng nhập bằng</h3>
                <div class="error">Xin lỗi chức năng đăng nhập bằng liên kết ngoài đang tạm khóa</div>
                <div class="facebook option">
                    <i class="fab fa-facebook-f"></i>
                    <a href="" class="text-light">Facebook</a>
                </div>
                <div class="google option">
                    <i class="fab fa-google"></i>
                    <a href="" class="text-light">Google</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>