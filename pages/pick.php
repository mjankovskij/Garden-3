<div class="plants">
    <?php foreach ($plants->getAllPlants() as $obj) : ?>
        <div class='plant' id='p<?= $obj->getId() ?>'>
            <img src='<?= $dom ?>/img/<?= $obj->getType() ?>/<?= $obj->getImg() ?>.jpg' alt='plant'>
            <div class='about'>
                Nr: <?= $obj->getId() ?><br>
                Kiekis: <span><?= $obj->getCount() ?></span><br>
            </div>
            <div class='pick' id='<?= $obj->getId() ?>'>
                <form>
                    <label for="count">Kiek skinti:</label>
                    <input type="text" name="count" pattern="[0-9]{1,}" title="Įveskite kieki (0 - <?= $obj->getCount() ?>)" autocomplete="off">
                    <button type="submit" id='some'>Skinti</button>
                </form>
                <button type="submit" id='all'>Skinti viska</button>
            </div>
        </div>
    <?php endforeach ?>
</div>

<script>
    const DOM1 = document.querySelectorAll('.pick button#some');
    for (let i = 0; i < DOM1.length; i++) {
        DOM1[i].addEventListener('click', (e) => {
            e.preventDefault();

            const id = document.querySelectorAll('.pick')[i]['id'];
            const count = document.querySelectorAll('input')[i].value;
            const max = Number(document.querySelectorAll('.about span')[i].innerText);

            document.querySelectorAll('input')[i].value = '';
            axios({
                    method: 'post',
                    data: {
                        action: 'pick',
                        id: id,
                        count: count,
                    },
                    url: './axios.php',
                })
                .then(function(response) {
                    if (response.data.error) {
                        alert(response.data.error)
                    } else {
                        document.querySelectorAll('.about span')[i].innerText = max - count;
                    }
                });
        })
    }

    
    const DOM2 = document.querySelectorAll('.pick button#all');
    for (let i = 0; i < DOM2.length; i++) {
        DOM2[i].addEventListener('click', (e) => {
            e.preventDefault();

            const id = document.querySelectorAll('.pick')[i]['id'];
            const max = Number(document.querySelectorAll('.about span')[i].innerText);

            axios({
                    method: 'post',
                    data: {
                        action: 'pick',
                        id: id,
                        count: max,
                    },
                    url: './axios.php',
                })
                .then(function(response) {
                    if (response.data.error) {
                        alert(response.data.error)
                    } else {
                        document.querySelectorAll('.about span')[i].innerText = 0;
                    }
                });
        })
    }
</script>