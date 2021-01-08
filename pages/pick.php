<div class="plants">
    <?php foreach (Db::getObjects(['table'  => 'garden', 'sort' => 'DESC']) as $obj) : ;?>
        <div class='plant' id='p<?= $obj->getId() ?>'>
            <img src='<?= $dom ?>/img/<?= $obj->getType() ?>/<?= $obj->getImg() ?>.jpg' alt='plant'>
            <div class='about'>
                Nr: <?= $obj->getId() ?><br>
                Kiekis: <span><?= $obj->getQuantity() ?></span><br>
            </div>
            <div class='pick' id='<?= $obj->getId() ?>'>
                <form>
                    <label for="quantity">Kiek skinti:</label>
                    <input type="text" name="quantity" pattern="[0-9]{1,}" title="Įveskite kieki (0 - <?= $obj->getQuantity() ?>)" autocomplete="off">
                    <button type="submit" id='some'>Skinti</button>
                </form>
                <button type="submit" id='all'>Skinti viska</button>
            </div>
        </div>
    <?php endforeach ?>
</div>

<script src="<?= $dom ?>/js/pick.js"></script>