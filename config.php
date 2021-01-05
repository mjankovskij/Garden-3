<?php
$url = explode('/', $_SERVER['REQUEST_URI']);
$link = $dom = 'http://' . $_SERVER['SERVER_NAME'] . "$url[0]/$url[1]/$url[2]/$url[3]";
if(isset($url[4])) $link .= '/'.$url[4];
$page = $url[4];