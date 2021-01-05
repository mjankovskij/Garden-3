class Error {
    constructor(message) {
        this.message = message;
        document.querySelector('body').insertAdjacentHTML('afterbegin', ` <div class="error">${this.message}</div>`);

        setTimeout(() => {
            const DOM = document.querySelectorAll('body .error');
            for (let i = 0; i < DOM.length; i++) {
                DOM[i].remove();
            }
        }, 1500);
    }
}