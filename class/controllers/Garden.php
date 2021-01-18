<?php

namespace Controller;

use Plants, Db;

class Garden
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
        return include_once DIR.'/pages/garden.php';
    }

    public function plantNew()
    {
        if ((Plants::plantNew($this->data->type, $this->data->quantity)) != 'OK') {
            http_response_code(400);
            echo json_encode([
                'message' => (Plants::plantNew($this->data->type, $this->data->quantity)),
            ]);
        } else {
            http_response_code(201);
            $array = [];
            foreach (Db::getObjects(['table'  => 'garden', 'sort' => 'DESC', 'limit' => $this->data->quantity, 'invert' => 1]) as $key => &$item) {
                $array[$key]['id'] = $item->getId();
                $array[$key]['type'] = $item->getType();
                $array[$key]['img'] = $item->getImg();
                $array[$key]['currentPrice'] = Currency::convert($item->getPrice(), CURRENCY);
            }
            echo json_encode([
                'message' => $array
            ]);
        }
        die;
    }

    public function uproot()
    {
        if ((Plants::uproot($this->data->id)) == 'OK') {
            http_response_code(200);
            echo json_encode([
                'message' => 'Išrautas',
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                'message' => (Plants::uproot($this->data->id)),
            ]);
        }
        die;
    }
}
