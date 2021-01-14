<?php
require_once __DIR__ . '/config.php'; 
require_once __DIR__ . '/axios.php'; 
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