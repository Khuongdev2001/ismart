<?php

function get_menu_db()
{
    $sql = "SELECT * FROM `tbl_menu`";
    $result = db_fetch_array($sql);
    return $result;
}

// check login username input password input
function check_login($username, $password)
{
    // remove characters 
    $username = vali_string($username);
    $sql = "SELECT `users`.* ,`roles`.`name` FROM `users` LEFT JOIN `user_roles` ON `users`.`id`=`user_roles`.`user_id` LEFT JOIN `roles` ON `roles`.`id`=`user_roles`.`role_id` WHERE `username`='{$username}' AND `password`='{$password}'";
    $user = db_fetch_row($sql);
    // check role customer k được vào
    if (!empty($user)) {
        // login thành công sẽ update date login
        $where = "`username`='{$username}'";
        $data = ['date_login' => get_date_now()];
        db_update('users', $data, $where);
        return $user;
    }
    return false;
}

#get info login session
function update_date_login($username, $password)
{
    $where = "`username`='{$username}' AND `password`='{$password}'";
    $data = array('date_login_last' => get_date_now());
    db_update('tbl_user', $data, $where);
}

// Check email exits send token 
function user_exist($email)
{
    $sql = "SELECT * FROM `tbl_user` WHERE `email`='{$email}'";
    if (db_fetch_row($sql) > 0) {
        return true;
    }
    return false;
}
// Create token
function set_token()
{
    $token = "ISMART" . rand(1000, 2000) . rand(1, 100);
    return $token;
}

// 
function add_user($user)
{
    db_insert('tbl_user', $user);
}
