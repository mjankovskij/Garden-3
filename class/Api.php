<?php

class Api
{
    public static function get($link)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $answer = json_decode(curl_exec($ch));
        return $answer;
    }
}
