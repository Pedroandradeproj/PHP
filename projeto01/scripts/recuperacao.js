document.addEventListener('DOMContentLoaded', function () {
    var emailInput = document.getElementById('email');
    var enviarBtn = document.getElementById('enviarBtn');
    var mensagemErroEmail = document.getElementById('mensagemErroEmail');
    
    emailInput.addEventListener('input', function () {
        validarEmail(emailInput.value.trim());
    });

    function validarEmail(email) {
        var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email.trim() === "") {
            mensagemErroEmail.textContent = '';
            mensagemErroEmail.classList.remove('error-message');
            mensagemErroEmail.classList.remove('success-message');
            return false; // Retorna falso se o e-mail estiver vazio
        } else if (!regexEmail.test(email)) {
            mensagemErroEmail.textContent = 'O e-mail inserido não é válido.';
            mensagemErroEmail.classList.remove('success-message');
            mensagemErroEmail.classList.add('error-message');
            return false; // Retorna falso se o e-mail não for válido
        } else {
            mensagemErroEmail.textContent = '';
            mensagemErroEmail.classList.remove('error-message');
            mensagemErroEmail.classList.add('success-message');
            return true; // Retorna verdadeiro se o e-mail for válido
        }
    }
});
