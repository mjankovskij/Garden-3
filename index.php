<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/axios.php';

if (isset($url[5]) && isset($url[6]) && $url[5] == 'setCurrency') {
    $exists = false;
    foreach (Currency::$symbol as $key => $_) {
        if ($key == $url[6]) {
            $exists = true;
        }
    }
    if($exists){
        setcookie('garden_currency', $url[6], time() + 365 * 24 * 60 * 60, "/");

        Api::redirect(URL.'/'.(PAGE??''));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garden v3</title>
    <link rel="stylesheet" href="<?= URL ?>/style.css">
    <script src="<?= URL ?>/js/Err.js"></script>
</head>

<body>
    <header>
<div class="currency">
<form>
        <label for="currency">Valiuta:</label>
        <select name="currency" onchange="location = this.value;">
        <?php foreach (Currency::$symbol as $key => $item): ?>

        <option value="<?= URL.'/'.(PAGE??'').'/setCurrency/'.$key ?>"><?= $key.' '.$item ?></option>
            
            <?php endforeach ?>
        </select>
</div>

        <nav>
            <?= App::links(); ?>
        </nav>
    </header>
    <main>
        <?php App::route(); ?>
    </main>
</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</html>


<!-- marek@jankovskij.lt -->