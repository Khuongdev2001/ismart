<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/bootstrap/bootstrap.min.css">
    <script src="public/js/jquery-3.5.1.min.js"></script>
    <script src="public/js/login.js"></script>
    <title>LOGIN ADMIN ISMART</title>
</head>

<body>
    <form action="" method="post" id="form-login">
        <h4 class="mb-4">LOGIN</h4>
        <div class="form-group position-relative my-4">
            <span id="label-username" class="label_field">Tên Đăng nhập</span>
            <input type="text" name="username" class="d-block rounded w-100" autocomplete="off" id="username" value="<?php echo set_value("username"); ?>">
            <?php
            echo form_error("username");
            ?>
        </div>
        <div class="form-group position-relative my-4">
            <span id="label-password" class="label_field">Mật Khẩu</span>
            <input type="password" name="password" class="d-block rounded w-100" id="password">
            <?php
            echo form_error("password");
            ?>
        </div>
        <div class="form-group">
            <button class="btn btn-warning my-3" name="btn_login">Đăng Nhập</button>
            <?php
            echo form_error("login");
            ?>
        </div>
    </form>
</body>

</html>