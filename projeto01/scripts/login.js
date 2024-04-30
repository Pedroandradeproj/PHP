
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var visibilityIcon = document.getElementById("visibilityIcon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        visibilityIcon.textContent = "visibility_off";
    } else {
        passwordInput.type = "password";
        visibilityIcon.textContent = "visibility";
    }
}
function formatarCampo() {
    var campo = document.getElementById('usuario').value;
    var usuarioInput = document.getElementById('usuario');
    if (isEmail(campo)) {
        // Não é necessário formatação, é um e-mail válido
        usuarioInput.value = campo; // Mantém o valor original
    } else {
        // Assume-se que é um CPF, adiciona formatação com pontos
        usuarioInput.value = formatarCPF(campo);
    }
}

function isEmail(valor) {
    // Expressão regular para verificar se o valor é um e-mail válido
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(valor);
}

function formatarCPF(cpf) {
    // Adiciona a formatação com pontos
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}