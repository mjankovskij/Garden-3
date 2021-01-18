<?php
defined('DOOR_BELL') || include_once '../404.php';
Controller\Header::render();
?>

<form id='growAll'>
    <div class="plantNew">
        <button type="button">Auginti</button>
    </div>
    <div class="plants">
    <?php foreach (Db::getObjects(['table'  => 'garden', 'sort' => 'DESC']) as $obj) : ;?>
            <div class='plant'>
                <img src='<?= URL ?>/img/<?= $obj->getType() ?>/<?= $obj->getImg() ?>.jpg' alt='plant'>
                <div class='about'>
                    Nr: <?= $obj->getId() ?> <br>
                    Kiekis: <span id='k<?= $obj->getId() ?>'><?= $obj->getQuantity() ?></span><br>
                    Uzaugs: <span id='u<?= $obj->getId() ?>'><?= $obj->getWillGrow(); ?></span>
                    <input type="hidden" name="<?= $obj->getId() ?>" value="<?= $obj->getWillGrow(); ?>" id="d<?= $obj->getId() ?>">
                </div>
            </div>
        <?php endforeach ?>
    </div>
</form>

</main>
</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="<?= URL ?>/js/grow.js"></script>

</html>