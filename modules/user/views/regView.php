<?php
get_header();
?>
<div id="wp-wrapper">
    <div id="wrapper">
        <div id="top-form" class="row">
            <h2 id="title-form" class="col-md-6">Chào mừng đến Đăng ký của Ismart.</h2>
            <p id="login" class="col-md-6">Đã có tài khoản <a href="?mod=user&action=login">Đăng nhập</a> ngay!</p>
        </div>
        <form id="form-reg" method="POST" class="row">
            <div id="box-left" class="col-md-6">
                <div class="form-group">
                    <label for="">Họ và tên*</label>
                    <?php echo form_error("fullname"); ?>
                    <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo set_value("fullname"); ?>">
                </div>
                <div class="form-group">
                    <label for="">Email*</label>
                    <?php echo form_error("email"); ?>
                    <small id="notification"></small>
                    <small id="sucess"></small>
                    <div class="box-input position-relative">
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo set_value("email"); ?>">
                        <a id="send_asset_token">Gửi mã xác nhận</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mã xác nhận*</label>
                    <?php echo form_error("token"); ?>
                    <input type="text" name="token" id="token" class="form-control" placeholder="Mã sẽ được gửi khi bạn nhập email và xác nhận" value="<?php echo set_value("token"); ?>">
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại*</label>
                    <?php echo form_error("numberphone"); ?>
                    <input type="text" name="numberphone" id="numberphone" class="form-control" value="<?php echo set_value("numberphone"); ?>">
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ*</label>
                    <?php echo form_error("address"); ?>
                    <textarea name="address" id="" cols="30" rows="2" id="address" class="form-control"><?php echo set_value("address"); ?></textarea>
                </div>
            </div>
            <div id="box-right" class="col-md-6">
                <div class="form-group">
                    <label for="">Tài khoản*</label>
                    <?php echo form_error("username"); ?>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value("username"); ?>">
                </div>
                <div class="form-group position-relative">
                    <label for="">Mật khẩu*</label>
                    <?php echo form_error("password"); ?>
                    <div class="box-input position-relative">
                        <input type="password" name="password" id="password" class="form-control">
                        <a id="toggle-seen"><i class="fas fa-eye-slash"></i></a>
                    </div>
                </div>
                <?php echo form_error("reg"); ?>
                <button id="btn_reg" name="btn_reg">Đăng ký</button>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
?>
<script>
    $(document).ready(function() {
        /* seen password */
        // tạo danh sách chọn
        let status = ['password', 'username'];
        $("#toggle-seen").click(function() {
            $(this).children('i').toggleClass("fa-eye fa-eye-slash");
            active = $(this).children('i').hasClass("fa-eye");
            $("#password").attr('type', status[Number(active)]);
        })
        /* send token */
        $("#send_asset_token").click(function() {
            let email = $("#email").val();
            if (email.length > 5) {
                // satisfied
                $("#notification").text("Nếu có lỗi sẽ thông báo ! còn k xin hãy chờ vài giây..");
                $.ajax({
                    url: "?mod=user&action=sendToken",
                    method: "post",
                    dataType: 'json',
                    data: ({
                        'send_token': true,
                        'email': email
                    }),
                    success: function(data) {
                        $("#notification").text(data.email);
                       if(data.status){
                        $("#notification").text("");
                        $("#sucess").text("gửi thành công")
                       }
                    }
                })
            } else {
                // send error;
                $("#notification").text("Bạn không được bỏ trống");
            }
        })
    })
</script>