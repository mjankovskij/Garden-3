const DOM1 = document.querySelectorAll('.pick button#some');
for (let i = 0; i < DOM1.length; i++) {
    DOM1[i].addEventListener('click', (e) => {
        e.preventDefault();

        const id = document.querySelectorAll('.pick')[i]['id'];
        const quantity = document.querySelectorAll('input')[i].value;
        const max = Number(document.querySelectorAll('.about span')[i].innerText);

        document.querySelectorAll('input')[i].value = '';
        axios({
                method: 'post',
                data: {
                    action: 'pick',
                    id: id,
                    quantity: quantity,
                },
                url: './axios.php',
            })
            .then(function(response) {
                if (response.data.error) {
                    new Error(response.data.error);
                    // alert(response.data.error)
                } else {
                    document.querySelectorAll('.about span')[i].innerText = max - quantity;
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
                    quantity: max,
                },
                url: './axios.php',
            })
            .then(function(response) {
                if (response.data.error) {
                    new Error(response.data.error);
                    // alert(response.data.error)
                } else {
                    document.querySelectorAll('.about span')[i].innerText = 0;
                }
            });
    })
}