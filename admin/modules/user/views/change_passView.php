<?php
get_header();
?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('user');
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php
                        echo form_success('success_change_pass');
                    ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="pass_old">Mật khẩu cũ</label>
                            <input type="password" name="pass_old" id="pass_old" class="form-control">
                            <?php echo form_error('pass_old'); ?>
                        </div>
                        <div class="form-group">
                            <label for="pass_new">Mật khẩu mới</label>
                            <input type="password" name="pass_new" id="pass_new" class="form-control">
                            <?php echo form_error('pass_new'); ?>
                        </div>
                        <div class="form-group">
                            <label for="confirm_pass">Xác nhận mật khẩu</label>
                            <input type="password" name="confirm_pass" id="confirm_pass" class="form-control">
                        </div>
                        <?php echo form_error('change_pass'); ?>
                        <button type="submit" name="btn_change" id="btn-change">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>