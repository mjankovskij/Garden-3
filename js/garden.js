setUproot(document.querySelectorAll('.plant .about .uproot').length);

function setUproot(length) {
    const DOM = document.querySelectorAll('.plant .about .uproot');
    for (let i = 0; i < length; i++) {
        DOM[i].addEventListener('click', () => {
            const id = DOM[i]['id'];
            axios({
                    method: 'post',
                    data: {
                        action: 'uproot',
                        id: id,
                    },
                    url: './axios.php',
                })
                .then(function(response) {
                    if (response.data.error) {
                        new Error(response.data.error);
                        // alert(response.data.error)
                    } else {
                        document.querySelector(`#p${id}.plant`).style.opacity = '0.2';
                        document.querySelector(`#p${id}.plant`).innerHTML = `<div class='uprooted'>${response.data.message}</div>`;
                        setTimeout(() => {
                            document.querySelector(`#p${id}.plant`).remove();
                        }, 500);
                    }
                });
        })
    }
}

document.querySelectorAll('.plantNew button')[0].addEventListener('click', (e) => {
    e.preventDefault();
    const type = document.querySelector('.plantNew select').value;
    const quantity = document.querySelector('.plantNew input').value;
    document.querySelector('.plantNew input').value = '';
    axios({
            method: 'post',
            data: {
                action: 'plantNew',
                type: type,
                quantity: quantity,
            },
            url: './axios.php',
        })
        .then(function(response) {
            if (response.data.error) {
                new Error(response.data.error);
                // alert(response.data.error)
            } else {
                console.log(response.data);
                for (let i = 0; i < response.data.message.length; i++) {
                    const data = response.data.message[i];
                    document.querySelector('.plants').insertAdjacentHTML('afterbegin', `<div class='plant' id='p${data.id}'>
                <img src='./img/${data.type}/${data.img}.jpg' alt='plant'>
                <div class='about'>
                    Nr: ${data.id}<br>
                    Kiekis: 0<br>
                    <div class='uproot' id='${data.id}'><p>Išrauti</p></div>
                </div>
            </div>`);
                }
                setUproot(response.data.message.length);
            }
        });
})