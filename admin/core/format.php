<?php
function currency_format($number, $suffix = 'VNĐ')
{
    if (!empty($number)) {
        return number_format($number) . $suffix;
    }
}
