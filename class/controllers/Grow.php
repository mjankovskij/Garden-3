<?php

namespace Controller;

use Plants;

class Grow
{

    public function render()
    {
        return include_once DIR . '/pages/grow.php';
    }


    public function growAll()
    {
        $action = Plants::growAll();
        if (gettype($action) != 'array') {
            http_response_code(400);
            echo json_encode([
                'message' => $action,
            ]);
        } else {
            http_response_code(200);
            echo json_encode([
                'message' => $action
            ]);
        }
        die;
    }
}
