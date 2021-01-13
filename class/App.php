<?php

class App
{
    public static function links()
    {
        return '<a href="' . URL . '/garden">Sodas</a>
        <a href="' . URL . '/grow">Auginimas</a>
        <a href="' . URL . '/pick">Skynimas</a>';
    }

    public static function route()
    {
        if (PAGE != '' && file_exists(DIR . '/pages//' . PAGE . '.php')) {
            include_once DIR . '\pages\\' . PAGE . '.php';
        } else {
            include_once DIR . '\pages\garden.php';
        }
    }
}
