<?php

function get_user($id)
{
    $sql = "SELECT * FROM `users` WHERE `id`='{$id}'";
    $user = db_fetch_row($sql);
    return $user;
}
// check login username input password input
function check_login($username, $password)
{
    // remove characters 
    $username = vali_string($username);
    $sql = "SELECT `users`.* ,`roles`.`name` FROM `users` LEFT JOIN `user_roles` ON `users`.`id`=`user_roles`.`user_id` LEFT JOIN `roles` ON `roles`.`id`=`user_roles`.`role_id` WHERE `username`='{$username}' AND `password`='{$password}'";
    $user = db_fetch_row($sql);
    // check role customer k được vào
    if (!empty($user) && $user['name'] != 'Customer') {
        // login thành công sẽ update date login
        $where = "`username`='{$username}'";
        $data = ['date_login' => get_date_now()];
        db_update('users', $data, $where);
        return $user;
    }
    return false;
}

function get_id_user_login_by_email($email)
{
    $sql = "SELECT `id` FROM `users` WHERE `email`='{$email}'";
    $id = db_fetch_row($sql);
    return $id['id'];
}

function update_user($id, $user)
{
    $where = "`id`='{$id}'";
    db_update('users', $user, $where);
}

function check_password_login($id, $password)
{
    $sql = "SELECT * FROM `users` WHERE `id`='{$id}' AND `password`='$password'";
    if (db_num_rows($sql) > 0) {
        return true;
    }
    return false;
}

function change_pass($id, $password)
{
    $where = "`id`='{$id}'";
    db_update('users', ['password' => $password], $where);
}
