<?php
defined('DOOR_BELL') || include_once '../404.php';
Controller\Header::render();
?>

        <div class="plantNew">
            <form>
                <label for="plants">Pasodinti:</label>
                <select name="plants">
                    <option value="Cucumber">Agurkai</option>
                    <option value="Tomato">Pomidorai</option>
                    <option value="Pepper">Paprikos</option>
                </select>
                <label for="quantity"> kiekis:</label>
                <input type="text" name="quantity" pattern="[0-9]{1,}" title="Įveskite skaičius (1 - 5).">
                <button type="button">Sodinti</button>
            </form>
        </div>

        <div class="plants">
            <?php foreach (Db::getObjects(['table'  => 'garden', 'sort' => 'DESC']) as $obj) :; ?>
                <div class='plant' id='p<?= $obj->getId() ?>'>
                    <img src='<?= URL ?>/img/<?= $obj->getType() ?>/<?= $obj->getImg() ?>.jpg' alt='plant'>
                    <div class='about'>
                        Nr: <?= $obj->getId() ?> <br>
                        Kiekis: <?= $obj->getQuantity() ?><br>
                        Kaina/vnt.: <?= Controller\Currency::convert($obj->getPrice(), CURRENCY) ?><br>
                        <div class='uproot' id='<?= $obj->getId() ?>'>
                            <p>Išrauti</p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </main>
</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="<?= URL ?>/js/garden.js"></script>

</html>