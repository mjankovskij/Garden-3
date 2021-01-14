setUproot(document.querySelectorAll('.plant .about .uproot').length);

function setUproot(length) {
    const DOM = document.querySelectorAll('.plant .about .uproot');
    for (let i = 0; i < length; i++) {
        DOM[i].addEventListener('click', () => {
            const id = DOM[i]['id'];
            axios({
                    method: 'post',
                    data: {
                        id: id,
                    },
                    url: './uproot',
                })
                .then(function(response) {
                    document.querySelector(`#p${id}.plant`).style.opacity = '0.2';
                    document.querySelector(`#p${id}.plant`).innerHTML = `<div class='uprooted'>${response.data.message}</div>`;
                    setTimeout(() => {
                        document.querySelector(`#p${id}.plant`).remove();
                    }, 500);
                })
                .catch(function(error) {
                    if (error.request === undefined) {
                        new Err('Sistemos klaida.');
                    } else {
                        new Err(error.response.data.message);
                    }
                });
        })
    }
}

document.querySelectorAll('.plantNew button')[0].addEventListener('click', (e) => {
    // e.preventDefault();
    const type = document.querySelector('.plantNew select').value;
    const quantity = document.querySelector('.plantNew input').value;
    document.querySelector('.plantNew input').value = '';
    axios({
            method: 'post',
            data: {
                type: type,
                quantity: quantity,
            },
            url: './plantNew',
        })
        .then(function(response) {
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
        })
        .catch(function(error) {
            if (error.request === undefined) {
                new Err('Sistemos klaida.');
            } else {
                new Err(error.response.data.message);
            }
        });
})