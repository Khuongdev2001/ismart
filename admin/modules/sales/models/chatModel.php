<?php
function get_customer()
{
    $sql = "SELECT * FROM `users` LEFT JOIN `user_roles` ON `users`.`id`=`user_roles`.`user_id` LEFT JOIN `roles` ON `user_roles`.`role_id`=`roles`.`id` WHERE `status`='Customer'";
    $result = db_fetch_array($sql);
    return $result;
}
