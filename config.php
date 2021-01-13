<?php
require_once __DIR__ . '/vendor/autoload.php';
$url = explode('/', $_SERVER['REQUEST_URI']);
define('URL', 'http://' . $_SERVER['SERVER_NAME'] . "$url[0]/$url[1]/$url[2]/$url[3]");
define('PAGE', $url[4]);
define('DIR', __DIR__);



define('DOOR_BELL', 'ring');