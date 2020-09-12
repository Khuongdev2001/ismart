<div id="sidebar" class="fl-left">
    <ul id="list-cat">
        <li>
            <a href="<?php echo base_url("?mod=user&action=update"); ?>" <?php echo active_sidebar('update'); ?>>Cập nhật tài khoản</a>
        </li>
        <li>
            <a href="<?php echo base_url("?mod=user&action=changPass") ?>" <?php echo active_sidebar('changPass'); ?>>Đổi mật khẩu</a>
        </li>
        <li>
            <a href="<?php echo base_url("?mod=user&action=logout"); ?>" <?php echo active_sidebar(''); ?>>Thoát</a>
        </li>
    </ul>
</div>