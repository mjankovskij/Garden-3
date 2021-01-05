<form action="<?= $dom ?>/growAll" method="POST">
    <div class="plantNew">
        <button type="submit">Auginti</button>
    </div>
    <div class="plants">
        <?php foreach ($plants->getAllPlants() as $obj) : ?>
            <div class='plant' id='p<?= $obj->getId() ?>'>
                <img src='<?= $dom ?>/img/<?= $obj->getType() ?>/<?= $obj->getImg() ?>.jpg' alt='plant'>
                <div class='about'>
                    Nr: <?= $obj->getId() ?> <br>
                    Kiekis: <?= $obj->getCount() ?><br>
                    Uzaugs: <?php
                            $typeUpper = ucfirst($obj->getType());
                            $plant =  new $typeUpper;
                            $growCount = $plant->growCount();
                            echo $growCount;
                            ?>
                    <input type="hidden" name="<?= $obj->getId() ?>" value="<?= $growCount ?>">
                </div>
            </div>
        <?php endforeach ?>
    </div>
</form>