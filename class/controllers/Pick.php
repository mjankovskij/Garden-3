<?php

namespace Controller;

use Plants;

class Pick
{

    private $data;

    public function __construct()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
        header('Content-Type: application/json');
        $this->data = json_decode(file_get_contents("php://input"));
        }
    }

    public function render()
    {
        return include_once DIR.'/pages/pick.php';
    }

    public function pick()
    {
    if (empty($this->data->id) && empty($this->data->quantity)) {
        http_response_code(400);
        echo json_encode([
            'message' => 'Prašome pasitikslinti duomenis.',
        ]);
    } elseif ((Plants::pick($this->data->id, $this->data->quantity)) == 'OK') {
        http_response_code(200);
        echo json_encode([
            'message' => Plants::pick($this->data->quantity, $this->data->quantity),
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            'message' => (Plants::pick($this->data->id, $this->data->quantity)),
        ]);
    }
    die;
    }
}
