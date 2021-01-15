<?php

//sodinimas
if (PAGE == 'plantNew') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"));
    if ((Plants::plantNew($data->type, $data->quantity)) != 'OK') {
        http_response_code(400);
        echo json_encode([
            'message' => (Plants::plantNew($data->type, $data->quantity)),
        ]);
    } else {
        http_response_code(201);
        $array = [];
        foreach (Db::getObjects(['table'  => 'garden', 'sort' => 'DESC', 'limit' => $data->quantity, 'invert' => 1]) as $key=>&$item) {
            $array[$key]['id'] = $item->getId();
            $array[$key]['type'] = $item->getType();
            $array[$key]['img'] = $item->getImg();
            $array[$key]['currentPrice'] = Currency::convert($item->getPrice(), 'USD');
        }
        echo json_encode([
            'message' => $array
        ]);
    }
    die;
}

// rovimas
if (PAGE == 'uproot') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"));
    if ((Plants::uproot($data->id)) == 'OK') {
        http_response_code(200);
        echo json_encode([
            'message' => 'Išrautas',
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            'message' => (Plants::uproot($data->id)),
        ]);
    }
    die;
}

//skynimas
if (PAGE == 'pickPlants') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"));
    if (empty($data->id) && empty($data->quantity)) {
        http_response_code(400);
        echo json_encode([
            'message' => 'Prašome pasitikslinti duomenis.',
        ]);
    } elseif ((Plants::pick($data->id, $data->quantity)) == 'OK') {
        http_response_code(200);
        echo json_encode([
            'message' => Plants::pick($data->quantity, $data->quantity),
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            'message' => (Plants::pick($data->id, $data->quantity)),
        ]);
    }
    die;
}

//auginimas visu augalu
if (PAGE == 'growAll') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents("php://input"));
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
