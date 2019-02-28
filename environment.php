<?php

if(! defined('ENVIRONMENT') )
{
    $domain = strtolower($_SERVER['HTTP_HOST']);

    switch($domain) {
        case 'seller.onitshamarket.com' :
        case 'www.seller.onitshamarket.com':
            define('ENVIRONMENT', 'production');
            break;

        case 'maindev.onitshamarket.com' :
            //our staging server
            define('ENVIRONMENT', 'staging');
            break;

        default :
            define('ENVIRONMENT', 'development');
            break;
    }
}