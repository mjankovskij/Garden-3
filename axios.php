<?php

$_POST = json_decode(file_get_contents("php://input"), true);
include_once __DIR__ . '/Plants.php';
include_once __DIR__ . '/Db.php';

if (!$_POST) {
    echo json_encode([
        'error' => 'Klaida.',
    ]);
    die;
}

// rovimas
if ($_POST['action'] == 'uproot') {
    if ((Plants::uproot($_POST['id'])) == 'OK') {
        echo json_encode([
            'message' => 'Išrautas',
        ]);
    } else {
        echo json_encode([
            'error' => (Plants::uproot($_POST['id'])),
        ]);
    }
}

//sodinimas
if ($_POST['action'] == 'plantNew') {
    if ($_POST['type'] != 'Cucumber' && $_POST['type'] != 'Tomato' && $_POST['type'] != 'Pepper') {
        echo json_encode([
            'error' => 'Tokiu daržovių nėra.',
        ]);
    } elseif ($_POST['quantity'] != (int)$_POST['quantity'] || $_POST['quantity'] < 1 || $_POST['quantity'] > 5) {
        echo json_encode([
            'error' => 'Prašome pasitikslinti sodinamą kiekį (1-5).',
        ]);
    } else {
        foreach (range(1, $_POST['quantity']) as $_) {
            Db::insert('garden', ['type' => $_POST['type'], 'img' => rand(1, 3), 'quantity' => 0]);
        }
        echo json_encode([
            'message' => Db::arrayTable(['table'  => 'garden', 'sort' => 'DESC', 'limit' => $_POST['quantity'], 'invert' => 1])
        ]);
    }
}


//skynimas
if ($_POST['action'] == 'pick') {
    if (empty($_POST['id']) && empty($_POST['quantity'])) {
        echo json_encode([
            'error' => 'Prašome pasitikslinti duomenis.',
        ]);
    } elseif ((Plants::pick($_POST['id'], $_POST['quantity'])) == 'OK') {
        echo json_encode([
            'message' => Plants::pick($_POST['quantity'], $_POST['quantity']),
        ]);
    } else {
        echo json_encode([
            'error' => (Plants::pick($_POST['id'], $_POST['quantity'])),
        ]);
    }
}
