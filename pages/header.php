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
            <?= (new Controller\Currency)->render() ?>
        </div>
        <nav>
        <a href="<?= URL ?>garden">Sodas</a>
        <a href="<?= URL ?>grow">Auginimas</a>
        <a href="<?= URL ?>pick">Skynimas</a>
        </nav>
    </header>
    <main>
    