<?php
// check length
function is_lenght($data)
{
    if (strlen($data) > 5 && strlen($data) < 30) {
        return true;
    };
    return false;
}
// check length address
function is_lenght_address($address)
{
    if (strlen($address) > 10) {
        return true;
    }
    return false;
}
// chek leng text
function is_length_text($address)
{
    if (strlen($address) > 5) {
        return true;
    }
    return false;
}
// check username
function is_username($username)
{
    $partter = "/^([a-zA-Z0-9-!]{6,32})$/";
    if (preg_match($partter, $username)) {
        return true;
    }
    return false;
};
// check password
function is_password($field)
{
    $parth = "/^([A-Z]{1})([a-z0-9A-Z!@#$%^&*()_+]{7,34})$/";
    if (preg_match($parth, $field)) {
        return true;
    }
    return false;
}
// check numberphone
function is_numberphone($numberphone)
{
    $parth = "/^(09|08|07|05|03[0-9]{1})([0-9]{7})$/";
    if (preg_match($parth, $numberphone)) {
        return true;
    }
    return false;
}
// check email
function is_email($email)
{
    $parth = "/^([a-zA-Z0-9]{3,30})@([a-z]{3,10}).([a-z]{3,10})$/";
    if (preg_match($parth, $email)) {
        return true;
    }
    return false;
}
// form error
function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field])) {
        $data = "<div class='error'>*{$error[$label_field]}</div>";
        return $data;
    }
    return false;
}

function form_success($data)
{
    global $$data;
    if (!empty($$data)) {
        return "<div class='alert alert-success py-1 w-75' role='alert'>{$$data}</div>";
    }
    return false;
}
// set value
function set_value($data)
{
    global $$data;
    if (!empty($$data)) {
        return $$data;
    }
    return false;
}
// validiton string input
function vali_string($str)
{
    global $conn;
    $str = htmlspecialchars($str);
    $str = mysqli_escape_string($conn, $str);
    return $str;
}

// check lenght product
function lenght_product($info)
{
    if (strlen($info) > 2) {
        return true;
    }
    return false;
}
