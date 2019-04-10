<?php
if (!function_exists('salt')) {
    function salt($length)
    {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789;:?.>,<!@#$%^&*()-_=+|';
        $randStringLen = $length;
        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $randString;
    }
}

if (!function_exists('generate_token')) {
    function generate_token($length)
    {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randStringLen = $length;
        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $randString;
    }
}

if (!function_exists('shaPassword')) {
    function shaPassword($field = "", $salt = "")
    {
        if ($field) {
            return hash('sha256', $field . $salt);
        }
    }
}

if (!function_exists('plushrs')) {
    function plushrs($dt, $hrs)
    {
        $pure = strtotime($dt);
        $plus = ($pure + 60 * 60 * $hrs);
        $newPure = date('Y-m-d H:i:s', $plus);
        return $newPure;
    }
}

if (!function_exists('ngn')) {
    function ngn($amt = '')
    {
        if ($amt == '') $amt = '0';
        return '₦ ' . number_format($amt);
    }
}

if (!function_exists('get_now')) {
    function get_now()
    {
        return gmdate("Y-m-d H:i:s", strtotime('-1 hour', time()));
    }
}

function get_percentage($total, $number)
{
    if ($total > 0) {
        return round($number / ($total / 100), 2);
    } else {
        return 0;
    }
}

function get_discount($sale_price, $discount_price)
{
    $percent = round((($sale_price - $discount_price) * 100) / $sale_price);
    return '-' . $percent . '%';
}


if (!function_exists('neatDate')) {
    function neatDate($dt)
    {
        $bdate = $dt;
        $bdate = str_replace('/', '-', $bdate);
        $nice_date = date('d M., Y', strtotime($bdate));
        return $nice_date;
    }
}

if (!function_exists('neatTime')) {
    function neatTime($dt)
    {
        $bdate = $dt;
        $bdate = str_replace('/', '-', $bdate);
        $nice_date = date('g:i a', strtotime($bdate));
        return $nice_date;
    }
}

function ago($time)
{
    $time = strtotime($time);
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
    $now = time();
    $difference = $now - $time;
    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }
    $difference = round($difference);
    if ($difference != 1) {
        $periods[$j] .= "s";
    }
    return "$difference $periods[$j] ago ";
}


function cleanit($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Clean phone number
function phoneclean($num)
{
    $num = preg_replace('/\D/', '', $num);
    $len = strlen($num);
    $accurate = $len - 10;
    $realNUM = substr($num, $accurate);
    return '0' . $realNUM;
}

function urlify($string, $id = '')
{
    $new_string = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    if ($id != '') {
        return 'product/' . $new_string . '-' . $id . '/';
    } else {
        return $new_string;
    }
}

if (!function_exists('productStatus')) {
    function productStatus($status)
    {
        switch ($status) {
            case 'pending':
            case 'shipped':
            case 'ordered':
                return '<label class="label label-table label-warning">' . ucfirst($status) . '</label>';
                break;
            case 'approved':
            case 'completed':
            case 'delivered':
                return '<label class="label label-table label-success">' . ucfirst($status) . '</label>';
                break;
            case 'missing_images':
                return '<label class="label label-table label-info">' . ucfirst($status) . '</label>';
                break;
            case 'returned':
            case 'failed_delivery':
            case 'canceled':
                return '<label class="label label-table label-danger">' . ucfirst($status) . '</label>';
                break;
            default:
                return '<label class="label label-table label-danger">' . ucfirst($status) . '</label>';
                break;
        }
    }
}

function current_full_url()
{
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url . '?' . $_SERVER['QUERY_STRING'] : $url;
}

if (!function_exists('paymentStatus')) {
    function paymentStatus($status)
    {
        switch ($status) {
            case 'pending':
                return '<label class="label label-table label-info" title="Payment is yet to be validated by seller">' . ucfirst($status) . '</label>';
                break;
            case 'completed':
                return '<label class="label label-table label-success">' . ucfirst($status) . '</label>';
                break;
            case 'processing':
                return '<label class="label label-table label-warning" title="Payment has been validated, but not yet paid">' . ucfirst($status) . '</label>';
                break;
            default:
                return '<label class="label label-table label-danger">' . ucfirst($status) . '</label>';
                break;
        }
    }
}
