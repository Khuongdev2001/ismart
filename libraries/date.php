<?php

function get_date_now($data="Y-m-d H:i:s"){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    return date($data);
}