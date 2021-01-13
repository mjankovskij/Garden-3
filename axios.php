<?php
header('Content-Type: application/json');
require_once __DIR__ . '/vendor/autoload.php';
$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    http_response_code(400);
    echo json_encode([
        'message' => 'Klaida.',
    ]);
    die;
}

//sodinimas
if ($data->action == 'plantNew') {
    if ((Plants::plantNew($data->type, $data->quantity)) != 'OK') {
        http_response_code(400);
        echo json_encode([
            'message' => (Plants::plantNew($data->type, $data->quantity)),
        ]);
        die;
    } else {
        http_response_code(201);
        echo json_encode([
            'message' => Db::arrayTable(['table'  => 'garden', 'sort' => 'DESC', 'limit' => $data->quantity, 'invert' => 1])
        ]);
    }
}

// rovimas
if ($data->action == 'uproot') {
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
}

//skynimas
if ($data->action == 'pick') {
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
}

if ($data->action == 'growAll') {
    $action = Plants::growAll($data->obj);
    if (gettype($action) != 'array') {
        http_response_code(400);
        echo json_encode([
            'message' => $action,
        ]);
    }else{
        http_response_code(200);
        echo json_encode([
            'message' => $action
        ]);
    }
}
