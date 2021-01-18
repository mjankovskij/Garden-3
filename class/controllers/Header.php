<?php

namespace Controller;

class Header
{
    public static function render()
    {
        return include_once DIR . '/pages/header.php';
    }

}
