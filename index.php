<?php
include_once __DIR__ . '/config.php';
include_once __DIR__ . '/Plants.php';
$plants = new Plants();

if ($page == 'growAll' && isset($_POST)) {

    foreach ($_POST as $key => $value) {
        $plants->grow($key, $value);
    }
    header("Location: $dom/grow");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garden v3</title>
    <link rel="stylesheet" href="<?= $dom ?>/style.css">
</head>

<body>

    <header>
        <nav>
            <a href="<?= $dom ?>/garden">Sodas</a>
            <a href="<?= $dom ?>/grow">Auginimas</a>
            <a href="<?= $dom ?>/pick">Skynimas</a>
        </nav>
    </header>

    <main>

        <?php
    $plants = new Plants();

        if ($page != '' && file_exists(__DIR__ . '/pages//' . $page . '.php')) {
            include_once __DIR__ . '\pages\\' . $page . '.php';
        } else {
            include_once __DIR__ . '\pages\garden.php';
        }
        ?>

    </main>

</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</html>


<!-- marek@jankovskij.lt -->