<?php
defined('APPPATH') or exit('Không được quyền truy cập phần này');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| Đây là những phần được load tự động khi ứng dụng khởi động
|
| 1. Libraries
| 2. Helper file
|
*/

/*
 * ------------------------------------------------------------------
 * Autoload Helper
 * ------------------------------------------------------------------
 * Ví dụ:
 * $autoload['helper'] = array('data','string');
 */


$autoload['helper'] = ['data', 'url', 'format'];

/*
 * ------------------------------------------------------------------
 * Autoload Libraries
 * ------------------------------------------------------------------
 * Ví dụ: 
 * $autoload['lib'] = array('validation', 'pagging');
 */


$autoload['lib'] = ['setting', 'template', 'valition', 'date', 'paginate', 'cart', 'session-login','mail'];
