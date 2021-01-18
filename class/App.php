<?php

class App
{

    public static function router()
    {
        if (URI[0] == '' || URI[0] == 'garden') {
            if (!isset(URI[1])) {
                return (new Controller\Garden)->render();
            }
            if (URI[1] == 'plantNew') {
                return (new Controller\Garden)->plantNew();
            }
            if (URI[1] == 'uproot') {
                return (new Controller\Garden)->uproot();
            }
        }

        if (URI[0] == 'grow') {
            if (!isset(URI[1])) {
                return (new Controller\Grow)->render();
            }
            if (URI[1] == 'growAll') {
                return (new Controller\Grow)->growAll();
            }
        }
        
        if (URI[0] == 'pick') {
            if (!isset(URI[1])) {
                return (new Controller\Pick)->render();
            }
            if (URI[1] == 'pick') {
                return (new Controller\Pick)->pick();
            }
        }

        if (isset(URI[1]) && URI[1] == 'setCurrency') {
            return (new Controller\Currency)->setCurrency();
        }
        return include_once DIR . '/404.php';
    }

    public static function redirect($link)
    {
        return header("Location: $link");
    }

}
