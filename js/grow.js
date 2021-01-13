const DOM = document.querySelector('.plantNew button');
DOM.addEventListener('click', (e) => {
    // e.preventDefault();
    const DOM = document.querySelectorAll('input');
    const obj = {};
    for (i = 0; i < DOM.length; i++) {
        obj[DOM[i].name] = DOM[i].value;
    }

    axios({
            method: 'post',
            data: {
                action: 'growAll',
                obj: obj
            },
            url: './axios.php',
        })
        .then(function(response) {
            const data = response.data.message;
            for (let i = 0; i < data.length; i++) {
                document.querySelector(`span#k${data[i].id}`).innerText = data[i].quantity;
                document.querySelector(`span#u${data[i].id}`).innerText = data[i].grow;
                document.querySelector(`input#d${data[i].id}`).value = data[i].grow;
            }
        })
        .catch(function(error) {
            if (error.request === undefined) {
                new Err('Sistemos klaida.');
            } else {
                new Err(error.response.data.message);
            }
        });
})