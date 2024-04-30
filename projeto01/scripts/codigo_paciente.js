document.addEventListener('DOMContentLoaded', function () {
    var codigoInputs = document.querySelectorAll('.codigo-inputs input');
    var enviarBtn = document.getElementById('enviarBtn');   
       
    enviarBtn.addEventListener('click', function () {
        // Validar o email antes de redirecionar
        if (mensagemErroEmail.textContent === '') {
            // Redirecionar para a página 'senha.html'
            window.location.href = 'login_paciente.php';
        }
    });


    codigoInputs.forEach(function (input, index) {
        input.addEventListener('input', function () {
            if (this.value.length > 1) {
                this.value = this.value.slice(0, 1);
            }

            if (this.value.length === 1 && index < codigoInputs.length - 1) {
                codigoInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && index > 0 && this.value.length === 0) {
                codigoInputs[index - 1].focus();
            }
        });
    });
});

    
    

