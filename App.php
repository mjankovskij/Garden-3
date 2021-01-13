<?php

class App{
    public static function links(){
        return '<a href="'.URL.'/garden">Sodas</a>
        <a href="'.URL.'/grow">Auginimas</a>
        <a href="'.URL.'/pick">Skynimas</a>';
    }

    public static function route(){
    if (PAGE != '' && file_exists(__DIR__ . '/pages//' . PAGE . '.php')) {
        include_once __DIR__ . '\pages\\' . PAGE . '.php';
    } else {
        include_once __DIR__ . '\pages\garden.php';
    }
    }
}