<?php

/*
 * ---------------------------------------------------------
 * BASE URL
 * ---------------------------------------------------------
 * Cấu hình đường dẫn gốc của ứng dụng
 * Ví dụ: 
 * http://hocweb123.com đường dẫn chạy online 
 * http://localhost/yourproject.com đường dẫn dự án ở local
 * 
 */

session_start();
ob_start();
$config['base_url'] = "http://localhost/unitop.vn/back-end/ismart_done/ismart.com/";


$config['default_module'] = 'home';
$config['default_controller'] = 'index';
$config['default_action'] = 'index';












