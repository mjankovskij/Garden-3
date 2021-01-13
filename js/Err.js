class Err {
    constructor(message) {
        this.message = message;
        document.querySelector('body').insertAdjacentHTML('afterbegin', ` <div class="error">${this.message}</div>`);

        setTimeout(() => {
            const DOM = document.querySelectorAll('body .error');
            for (let i = 0; i < DOM.length; i++) {
                DOM[i].remove();
            }
            (function(w) { w = w || window; var i = w.setInterval(function() {}, 100000); while (i >= 0) { w.clearInterval(i--); } })( /*window*/ );
        }, 1500)

    }
}