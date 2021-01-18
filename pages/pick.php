<?php
defined('DOOR_BELL') || include_once '../404.php';
Controller\Header::render();
?>

<div class="plants">
    <?php foreach (Db::getObjects(['table'  => 'garden', 'sort' => 'DESC']) as $obj) : ;?>
        <div class='plant' id='p<?= $obj->getId() ?>'>
            <img src='<?= URL ?>/img/<?= $obj->getType() ?>/<?= $obj->getImg() ?>.jpg' alt='plant'>
            <div class='about'>
                Nr: <?= $obj->getId() ?><br>
                Kiekis: <span><?= $obj->getQuantity() ?></span><br>
            </div>
            <div class='pick' id='<?= $obj->getId() ?>'>
                <form>
                    <label for="quantity">Kiek skinti:</label>
                    <input type="text" name="quantity" pattern="[0-9]{1,}" title="Įveskite kieki (0 - <?= $obj->getQuantity() ?>)" autocomplete="off">
                    <button type="button" id='some'>Skinti</button>
                </form>
                <button type="button" id='all'>Skinti viska</button>
            </div>
        </div>
    <?php endforeach ?>
</div>


</main>
</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="<?= URL ?>/js/pick.js"></script>

</html>