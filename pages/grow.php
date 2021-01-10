<form action="<?= $dom ?>/growAll" method="POST">
    <div class="plantNew">
        <button type="submit">Auginti</button>
    </div>
    <div class="plants">
    <?php foreach (Db::getObjects(['table'  => 'garden', 'sort' => 'DESC']) as $obj) : ;?>
            <div class='plant' id='p<?= $obj->getId() ?>'>
                <img src='<?= $dom ?>/img/<?= $obj->getType() ?>/<?= $obj->getImg() ?>.jpg' alt='plant'>
                <div class='about'>
                    Nr: <?= $obj->getId() ?> <br>
                    Kiekis: <?= $obj->getQuantity() ?><br>
                    Uzaugs: <?php
                            $typeUpper = ucfirst($obj->getType());
                            $name = 'plants\\'.$typeUpper;
                            $plant =  new $name;
                            $growQuantity = $plant->growQuantity();
                            echo $growQuantity;
                            ?>
                    <input type="hidden" name="<?= $obj->getId() ?>" value="<?= $growQuantity ?>">
                </div>
            </div>
        <?php endforeach ?>
    </div>
</form>