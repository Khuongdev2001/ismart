<?php
// hàm tiền tệ
function currency_format($number, $suffix = 'đ'){
    return number_format($number).$suffix;
}