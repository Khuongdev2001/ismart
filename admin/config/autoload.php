<?php
defined('APPPATH') OR exit('Không được quyền truy cập phần này');

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
 * Autoload Libraries
 * ------------------------------------------------------------------
 * Ví dụ: 
 * $autoload['lib'] = array('validation', 'paginate');
 */


$autoload['lib'] = array('validition','date','upload','paginate','data-tree','template','session-login');

/*
 * ------------------------------------------------------------------
 * Autoload Helper
 * ------------------------------------------------------------------
 * Ví dụ:
 * $autoload['helper'] = array('data','string');
 */


$autoload['helper'] = array('data','redirect_to','url','format','popup','string','str_to_array');








