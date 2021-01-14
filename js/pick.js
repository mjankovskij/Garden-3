const DOM1 = document.querySelectorAll('.pick button#some');
for (let i = 0; i < DOM1.length; i++) {
    DOM1[i].addEventListener('click', (e) => {
        // e.preventDefault();

        const id = document.querySelectorAll('.pick')[i]['id'];
        const quantity = document.querySelectorAll('input')[i].value;
        const max = Number(document.querySelectorAll('.about span')[i].innerText);

        document.querySelectorAll('input')[i].value = '';
        axios({
                method: 'post',
                data: {
                    id: id,
                    quantity: quantity,
                },
                url: './pickPlants',
            })
            .then(function() {
                document.querySelectorAll('.about span')[i].innerText = max - quantity;
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


const DOM2 = document.querySelectorAll('.pick button#all');
for (let i = 0; i < DOM2.length; i++) {
    DOM2[i].addEventListener('click', (e) => {
        // e.preventDefault();

        const id = document.querySelectorAll('.pick')[i]['id'];
        const max = Number(document.querySelectorAll('.about span')[i].innerText);

        axios({
                method: 'post',
                data: {
                    id: id,
                    quantity: max,
                },
                url: './pickPlants',
            })
            .then(function() {
                document.querySelectorAll('.about span')[i].innerText = 0;
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