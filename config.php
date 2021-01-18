<?php
require_once __DIR__ . '/vendor/autoload.php';
define('INSTALL_DIR', '/Projects/BIT/garden3/');

// $url = explode('/', $_SERVER['REQUEST_URI']);
define('URL', 'http://' . $_SERVER['SERVER_NAME'] . INSTALL_DIR);
define('URI', explode('/', str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI'])));
define('DIR', __DIR__);

if(isset($_COOKIE['garden_currency'])){
    define('CURRENCY', $_COOKIE['garden_currency']);
}else{
    define('CURRENCY', 'EUR');
}
