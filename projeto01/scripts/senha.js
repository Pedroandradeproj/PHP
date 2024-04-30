
document.addEventListener('DOMContentLoaded', function () {
    
    var senhaInput = document.getElementById('senha');
    var confirmarSenhaInput = document.getElementById('confirmar-senha');
    

    

    senhaInput.addEventListener('input', function () {
        validarSenha(senhaInput.value);
    });

    confirmarSenhaInput.addEventListener('input', function () {
        validarConfirmarSenha(confirmarSenhaInput.value, senhaInput.value);
    });
});


function togglePasswordVisibilityCadastro() {
    var senhaInput = document.getElementById("senha");
    var visibilityIconCadastro = document.getElementById("visibilityIconCadastro");

    if (senhaInput.type === "password") {
        senhaInput.type = "text";
        visibilityIconCadastro.textContent = "visibility_off";
    } else {
        senhaInput.type = "password";
        visibilityIconCadastro.textContent = "visibility";
    }
}
function toggleConfirmarSenhaVisibilityCadastro() {
    var confirmarSenhaInput = document.getElementById("confirmar-senha");
    var visibilityIconConfirmarCadastro = document.getElementById("visibilityIconConfirmarCadastro");

    if (confirmarSenhaInput.type === "password") {
        confirmarSenhaInput.type = "text";
        visibilityIconConfirmarCadastro.textContent = "visibility_off";
    } else {
        confirmarSenhaInput.type = "password";
        visibilityIconConfirmarCadastro.textContent = "visibility";
    }
}
function validarSenha(senha) {
    var condicoesAtendidas = 0;

    condicoesAtendidas += validarTamanhoMinimo(senha);
    condicoesAtendidas += validarLetraMaiuscula(senha);
    condicoesAtendidas += validarCaractereEspecial(senha);
    

    if (senha.trim() === "") {
        limparMensagensErroSenha();
        return;
    }
    else if (condicoesAtendidas === 3) {
        setTimeout(function () {
            var mensagemErroTamanho = document.getElementById('mensagemErroTamanho');
            var mensagemErroMaiuscula = document.getElementById('mensagemErroMaiuscula');
            var mensagemErroEspecial = document.getElementById('mensagemErroEspecial');

            mensagemErroTamanho.textContent = '';
            mensagemErroMaiuscula.textContent = '';
            mensagemErroEspecial.textContent = '';

            mensagemErroTamanho.classList.remove('error-message');
            mensagemErroMaiuscula.classList.remove('error-message');
            mensagemErroEspecial.classList.remove('error-message');

            mensagemErroTamanho.classList.remove('success-message');
            mensagemErroMaiuscula.classList.remove('success-message');
            mensagemErroEspecial.classList.remove('success-message');
        }, 3000);
    } else {
        var mensagemErroTamanho = document.getElementById('mensagemErroTamanho');
        var mensagemErroMaiuscula = document.getElementById('mensagemErroMaiuscula');
        var mensagemErroEspecial = document.getElementById('mensagemErroEspecial');

        mensagemErroTamanho.style.display = 'block';
        mensagemErroMaiuscula.style.display = 'block';
        mensagemErroEspecial.style.display = 'block';

        validarSenha();
    }
}
// Adicione esta função para limpar as mensagens de erro do campo de senha
function limparMensagensErroSenha() {
    var mensagemErroTamanho = document.getElementById('mensagemErroTamanho');
    var mensagemErroMaiuscula = document.getElementById('mensagemErroMaiuscula');
    var mensagemErroEspecial = document.getElementById('mensagemErroEspecial');

    mensagemErroTamanho.textContent = '';
    mensagemErroMaiuscula.textContent = '';
    mensagemErroEspecial.textContent = '';

    mensagemErroTamanho.classList.remove('error-message');
    mensagemErroMaiuscula.classList.remove('error-message');
    mensagemErroEspecial.classList.remove('error-message');

    mensagemErroTamanho.classList.remove('success-message');
    mensagemErroMaiuscula.classList.remove('success-message');
    mensagemErroEspecial.classList.remove('success-message');
}

function validarTamanhoMinimo(senha) {
    var mensagem = 'Mínimo de 8 caracteres.<br>';
    var condicaoAtendida = senha.length >= 8;

    atualizarMensagemEstilo('mensagemErroTamanho', mensagem, condicaoAtendida);

    return condicaoAtendida ? 1 : -1;
}

function validarLetraMaiuscula(senha) {
    var mensagem = 'Letra maiúscula.<br>';
    var condicaoAtendida = /[A-Z]/.test(senha);

    atualizarMensagemEstilo('mensagemErroMaiuscula', mensagem, condicaoAtendida);

    return condicaoAtendida ? 1 : -1;
}

function validarCaractereEspecial(senha) {
    var mensagem = 'Pelo menos 1 caractere especial.<br>';
    var condicaoAtendida = /[!@#$%^&*(),.?":{}|<>]/.test(senha);

    atualizarMensagemEstilo('mensagemErroEspecial', mensagem, condicaoAtendida);

    return condicaoAtendida ? 1 : -1;
}
function validarConfirmarSenha(confirmarSenha, senha) {
    var mensagemErroConfirmarSenha = document.getElementById('mensagemErroConfirmarSenha');

    if (confirmarSenha.trim() === "") {
        mensagemErroConfirmarSenha.textContent = '';
        mensagemErroConfirmarSenha.classList.remove('error-message');
        mensagemErroConfirmarSenha.classList.remove('success-message');
    } else if (confirmarSenha !== senha) {
        mensagemErroConfirmarSenha.textContent = 'As senhas não coincidem.';
        mensagemErroConfirmarSenha.classList.remove('success-message');
        mensagemErroConfirmarSenha.classList.add('error-message');
    } else {
        mensagemErroConfirmarSenha.textContent = '';
        mensagemErroConfirmarSenha.classList.remove('error-message');
        mensagemErroConfirmarSenha.classList.add('success-message');
    }
}
function atualizarMensagemEstilo(elementId, mensagem, condicaoAtendida) {
    var elemento = document.getElementById(elementId);

    elemento.innerHTML = mensagem;

    if (condicaoAtendida) {
        elemento.classList.remove('error-message');
        elemento.classList.add('success-message');
    } else {
        elemento.classList.remove('success-message');
        elemento.classList.add('error-message');
    }
}
document.addEventListener('DOMContentLoaded', function () {
    var codigoInputs = document.querySelectorAll('.codigo-inputs input');

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
document.addEventListener('DOMContentLoaded', function () {
    
    var enviarBtn = document.getElementById('enviarBtn');      
    enviarBtn.addEventListener('click', function () {
        // Validar o email antes de redirecionar
        if (mensagemErroEmail.textContent === '') {
            // Redirecionar para a página 'senha.html'
            window.location.href = 'login_funcionario.php';
        }
    });

});
