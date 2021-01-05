<?php

$_POST = json_decode(file_get_contents("php://input"), true);
include_once __DIR__ . '/Plants.php';
$plants = new Plants();

if (!$_POST) {
    echo json_encode([
        'error' => 'Klaida.',
    ]);
    die;
}

// rovimas
if ($_POST['action'] == 'uproot') {
    if (($plants->uproot($_POST['id'])) == 'OK') {
        echo json_encode([
            'message' => 'Išrautas',
        ]);
    } else {
        echo json_encode([
            'error' => ($plants->uproot($_POST['id'])),
        ]);
    }
}

//sodinimas
if ($_POST['action'] == 'plantNew') {
    if ($_POST['type'] != 'cucumber' && $_POST['type'] != 'tomato' && $_POST['type'] != 'pepper') {
        echo json_encode([
            'error' => 'Tokiu daržovių nėra.',
        ]);
    } elseif ($_POST['count'] != (int)$_POST['count'] || $_POST['count'] < 1 || $_POST['count'] > 5) {
        echo json_encode([
            'error' => 'Prašome pasitikslinti sodinamą kiekį (1-5).',
        ]);
    } else {
        foreach (range(1, $_POST['count']) as $_) {
            $plants->plantNew($_POST['type'], rand(1, 3));
        }
        echo json_encode([
            'message' => $plants->getLimitedArray($_POST['count'])
        ]);
    }
}


//skynimas
if ($_POST['action'] == 'pick') {
    if (empty($_POST['id']) && empty($_POST['count'])) {
        echo json_encode([
            'error' => 'Prašome pasitikslinti duomenis.',
        ]);
    } elseif (($plants->pick($_POST['id'], $_POST['count'])) == 'OK') {
        echo json_encode([
            'message' => $plants->pick($_POST['count'], $_POST['count']),
        ]);
    } else {
        echo json_encode([
            'error' => ($plants->pick($_POST['id'], $_POST['count'])),
        ]);
    }
}
