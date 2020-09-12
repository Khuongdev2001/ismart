<?php
// set data fullname username email phone address thumb_login
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar("user");
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php
                    echo form_success('success_update');
                    ?>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fullname">Tên hiển thị</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo set_value('fullname'); ?>">
                            <?php echo form_error("fullname"); ?>
                        </div>

                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('username') ?>">
                            <?php echo form_error("username"); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error("email"); ?>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="phone" name="phone" id="phone" class="form-control" value="<?php echo set_value('phone'); ?>">
                            <?php echo form_error("phone"); ?>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <textarea name="address" id="address" class="form-control"><?php echo set_value('address'); ?></textarea>
                            <?php echo form_error("address"); ?>
                        </div>
                        <label for="">Ảnh sản phẩm:</label>
                        <label for="upload-thumb">Click vào ảnh để upload</label>
                        <div id="uploadFile" class="position-relative">
                            <input type="file" name="thumbnail[]" id="upload-thumb" class="my-3 d-none">
                            <a id="btn_upload" class="position-absolute"><i class="fas fa-cloud-upload-alt"></i></a>
                            <img src="<?php echo set_value('thumbnail'); ?>" id="thumb_preview">
                            <?php
                            echo form_error('thumbnail');
                            ?>
                        </div>
                        <button type="submit" name="btn_update" id="btn-update">Cập nhật</button>
                    </form>
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
        $("#btn_upload").click(function() {
            $("#upload-thumb").trigger("click")
            return false;
        })
    })
</script>