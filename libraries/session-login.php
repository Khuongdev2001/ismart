<?php
/**
 * Hàm này có 2 công dụng
 * 
 * Nếu truyền vào tham số thì sẽ lưu tham số user làm session
 * 
 * Nếu k truyền vòa thì sẽ lấy user đã login hiện tại
 * 
 */

function session_login($user = "")
{
    // chú ý ngay cả cập nhật cũng sẽ reset lại sestion
    if (!empty($user)) {
        $_SESSION['user'] = $user;
        $_SESSION['user']['is_login'] = true;
        if (isset($_SESSION['user']['password']))
            unset($_SESSION['user']['password']);
    }
    return $_SESSION['user'];
}

/*
 *
 * Hàm này check login
 *  
 * Nếu người dùng đã login thì trả về tru
 * 
 * Ngược lại là trả về false
 * 
 * Hàm này dùng để check trong route
 * 
 */

function is_login()
{
    if (!empty($_SESSION['user']['is_login'])) {
        return true;
    }
    return false;
}
