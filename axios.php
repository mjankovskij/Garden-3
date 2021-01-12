<?php
header('Content-Type: application/json');
require_once __DIR__.'/vendor/autoload.php';
$data = json_decode(file_get_contents("php://input"));

if (!$data) {
    echo json_encode([
        'error' => 'Klaida.',
    ]);
    die;
}

// rovimas
if ($data->action == 'uproot') {
    if ((Plants::uproot($data->id)) == 'OK') {
        echo json_encode([
            'message' => 'Išrautas',
        ]);
    } else {
        echo json_encode([
            'error' => (Plants::uproot($data->id)),
        ]);
    }
}

//sodinimas
if ($data->action == 'plantNew') {
    if ((Plants::plantNew($data->type, $data->quantity)) != 'OK') {
        echo json_encode([
            'error' => (Plants::plantNew($data->type, $data->quantity)),
        ]);
    } else {
        echo json_encode([
            'message' => Db::arrayTable(['table'  => 'garden', 'sort' => 'DESC', 'limit' => $data->quantity, 'invert' => 1])
        ]);
    }
}


//skynimas
if ($data->action == 'pick') {
    if (empty($data->id) && empty($data->quantity)) {
        echo json_encode([
            'error' => 'Prašome pasitikslinti duomenis.',
        ]);
    } elseif ((Plants::pick($data->id, $data->quantity)) == 'OK') {
        echo json_encode([
            'message' => Plants::pick($data->quantity, $data->quantity),
        ]);
    } else {
        echo json_encode([
            'error' => (Plants::pick($data->id, $data->quantity)),
        ]);
    }
}
