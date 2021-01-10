<?php
$_POST = json_decode(file_get_contents("php://input"), true);
require_once __DIR__.'/vendor/autoload.php';

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
    if ((Plants::plantNew($_POST['type'], $_POST['quantity'])) != 'OK') {
        echo json_encode([
            'error' => (Plants::plantNew($_POST['type'], $_POST['quantity'])),
        ]);
    } else {
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
