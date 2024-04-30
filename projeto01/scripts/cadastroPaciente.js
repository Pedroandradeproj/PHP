
document.addEventListener('DOMContentLoaded', function () {
    var nomeInput = document.getElementById('nome');
    var emailInput = document.getElementById('email');
    var telefoneInput = document.getElementById('telefone');
    var rgInput = document.getElementById('rg'); 
    var dataNascimentoInput = document.getElementById('data-nascimento'); // Adicionando referência ao campo de data de nascimento
    

    // Adicionando evento ao campo de nome para formatar para maiúsculas
    nomeInput.addEventListener('input', function () {
        corrigirFormatoNome(nomeInput);
        validarNome(nomeInput.value.trim());
    });

    emailInput.addEventListener('input', function () {
        validarEmail(emailInput.value.trim());
    });

    telefoneInput.addEventListener('input', function () {
        formatarTelefone(telefoneInput);
        validarTelefone(telefoneInput.value.trim());
    });
    rgInput.addEventListener('input', function () {
        formatarRG(rgInput);
        validarRG(rgInput.value.trim());
    });
     // Adicionando evento ao campo de data de nascimento para validar a data
     dataNascimentoInput.addEventListener('input', function () {
        validarDataNascimento(dataNascimentoInput.value);
    });
    
});

function corrigirFormatoNome(nomeInput) {
    var nomeArray = nomeInput.value.split(' ');

    for (var i = 0; i < nomeArray.length; i++) {
        nomeArray[i] = nomeArray[i].charAt(0).toUpperCase() + nomeArray[i].slice(1).toLowerCase();
    }

    var nomeCorrigido = nomeArray.join(' ');

    nomeInput.value = nomeCorrigido;
}

function validarNome(nome) {
    var regex = /^[a-zA-ZÀ-ÿ\s']+$/;
    var mensagemErroNome = document.getElementById('mensagemErroNome');

    if (nome.trim() === "") {
        mensagemErroNome.textContent = '';
        mensagemErroNome.classList.remove('error-message');
        mensagemErroNome.classList.remove('success-message');
    } else if (!regex.test(nome)) {
        mensagemErroNome.textContent = 'O nome deve conter apenas letras.';
        mensagemErroNome.classList.remove('success-message');
        mensagemErroNome.classList.add('error-message');
    } else {
        mensagemErroNome.textContent = '';
        mensagemErroNome.classList.remove('error-message');
        mensagemErroNome.classList.add('success-message');
    }
}

function validarEmail(email) {
    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var mensagemErroEmail = document.getElementById('mensagemErroEmail');

    if (email.trim() === "") {
        mensagemErroEmail.textContent = '';
        mensagemErroEmail.classList.remove('error-message');
        mensagemErroEmail.classList.remove('success-message');
    } else if (!regexEmail.test(email)) {
        mensagemErroEmail.textContent = 'O e-mail inserido não é válido.';
        mensagemErroEmail.classList.remove('success-message');
        mensagemErroEmail.classList.add('error-message');
    } else {
        mensagemErroEmail.textContent = '';
        mensagemErroEmail.classList.remove('error-message');
        mensagemErroEmail.classList.add('success-message');
    }
}


function validarTelefone(telefone) {
    var regexTelefone = /^(\d{9}|\d{11})$/;
    var mensagemErroTelefone = document.getElementById('mensagemErroTelefone');

    var telefoneLimpo = telefone.replace(/\D/g, '');

    if (telefone.trim() === "") {
        mensagemErroTelefone.textContent = '';
        mensagemErroTelefone.classList.remove('error-message');
        mensagemErroTelefone.classList.remove('success-message');
    } else if (!regexTelefone.test(telefoneLimpo)) {
        mensagemErroTelefone.textContent = 'O telefone deve ter 9 ou 11 dígitos numéricos.';
        mensagemErroTelefone.classList.remove('success-message');
        mensagemErroTelefone.classList.add('error-message');
    } else {
        mensagemErroTelefone.textContent = '';
        mensagemErroTelefone.classList.remove('error-message');
        mensagemErroTelefone.classList.add('success-message');
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

function formatarTelefone(telefoneInput) {
    var value = telefoneInput.value.replace(/\D/g, '');
    var regexTelefone = /^(\d{0,2})(\d{0,5})(\d{0,4})$/;

    telefoneInput.value = value.replace(regexTelefone, function (regex, grupo1, grupo2, grupo3) {
        var formatted = grupo1;

        if (grupo2) {
            formatted += '-' + grupo2;
        }
        if (grupo3) {
            formatted += '-' + grupo3;
        }

        return formatted;
    });
}


function formatarCPF(cpfInput) {
    var value = cpfInput.value.replace(/\D/g, '');
    var regexCPF = /^(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})$/;

    cpfInput.value = value.replace(regexCPF, function (_, grupo1, grupo2, grupo3, grupo4) {
        var formatted = grupo1;

        if (grupo2) {
            formatted += '.' + grupo2;
        }
        if (grupo3) {
            formatted += '.' + grupo3;
        }
        if (grupo4) {
            formatted += '-' + grupo4;
        }

        return formatted;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var cpfInput = document.getElementById('cpf');
    var mensagemSucessoCPF = document.getElementById('mensagemSucessoCPF');

    cpfInput.addEventListener('input', function () {
        formatarCPF(cpfInput);
        validarCPF(cpfInput.value.trim()); // Não está definido, suponho que isso seja parte de outro código
    });

    var timeoutID;

    function mostrarMensagemSucesso() {
        mensagemSucessoCPF.textContent = 'CPF válido!';
        mensagemSucessoCPF.classList.add('success-message');

        // Definir tempo para remover a mensagem de sucesso após 3 segundos (3000 milissegundos)
        timeoutID = setTimeout(function () {
            mensagemSucessoCPF.textContent = '';
            mensagemSucessoCPF.classList.remove('success-message');
        }, 3000);
    }

    function limparMensagemSucesso() {
        clearTimeout(timeoutID);
        mensagemSucessoCPF.textContent = '';
        mensagemSucessoCPF.classList.remove('success-message');
    }

    cpfInput.addEventListener('focus', limparMensagemSucesso);
    cpfInput.addEventListener('blur', mostrarMensagemSucesso);
});
function formatarTelefoneEmergencia(telefoneInput) {
    var value = telefoneInput.value.replace(/\D/g, '');
    var regexTelefone = /^(\d{0,2})(\d{0,5})(\d{0,4})$/;

    telefoneInput.value = value.replace(regexTelefone, function (regex, grupo1, grupo2, grupo3) {
        var formatted = grupo1;

        if (grupo2) {
            formatted += '-' + grupo2;
        }
        if (grupo3) {
            formatted += '-' + grupo3;
        }

        return formatted;
    });
}

function validarTelefoneEmergencia(telefone) {
    var regexTelefone = /^(\d{9}|\d{11})$/;
    var mensagemErroTelefoneEmergencia = document.getElementById('mensagemErroTelefoneEmergencia');

    var telefoneLimpo = telefone.replace(/\D/g, '');

    if (telefone.trim() === "") {
        mensagemErroTelefoneEmergencia.textContent = '';
        mensagemErroTelefoneEmergencia.classList.remove('error-message');
        mensagemErroTelefoneEmergencia.classList.remove('success-message');
    } else if (!regexTelefone.test(telefoneLimpo)) {
        mensagemErroTelefoneEmergencia.textContent = 'O telefone de emergência deve ter 9 ou 11 dígitos numéricos.';
        mensagemErroTelefoneEmergencia.classList.remove('success-message');
        mensagemErroTelefoneEmergencia.classList.add('error-message');
    } else {
        mensagemErroTelefoneEmergencia.textContent = '';
        mensagemErroTelefoneEmergencia.classList.remove('error-message');
        mensagemErroTelefoneEmergencia.classList.add('success-message');
    }
}
function buscarEnderecoPorCEP(cep) {
    // Remova qualquer formatação do CEP
    cep = cep.replace(/\D/g, '');

    // Verifique se o CEP possui o tamanho correto
    if (cep.length !== 8) {
        // Se o CEP não tiver 8 dígitos, não é um CEP válido
        return;
    }

    // Fazer a requisição para a API de consulta de CEP
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
            // Preencher os campos com os dados retornados pela API
            document.getElementById('logradouro').value = data.logradouro || '';
            document.getElementById('cidade').value = data.localidade || '';
            document.getElementById('estado').value = data.uf || '';
            document.getElementById('numero').value = ''; // Limpa o campo número
            document.getElementById('complemento').value = ''; // Limpa o campo complemento
            document.getElementById('numero').focus(); // Mova o foco para o campo de número após preencher o endereço
        })
        .catch(error => console.error('Erro ao buscar endereço:', error));
}


// Função para formatar o número de identidade (RG)
function formatarRG(rgInput) {
    var value = rgInput.value.toUpperCase().replace(/[^A-Z0-9]/g, ''); // Remover caracteres especiais e converter para maiúsculas
    var regexRG = /^([A-Z]{2})(\d{8})$/; // Define a expressão regular para o formato do RG

    rgInput.value = value.replace(regexRG, '$1$2'); // Manter apenas letras e números

    validarRG(rgInput.value.trim()); // Validar o RG após a formatação
}
function validarRG(rg) {
    var mensagemErroRG = document.getElementById('mensagemErroRG');
    var mensagemEstado = document.getElementById('mensagemEstado'); // Adicionando elemento para exibir o estado
    var regexRG = /^[A-Z]{2}\d{0,8}$/; // Agora verifica que os dois primeiros caracteres são letras maiúsculas seguidos por até 8 dígitos


    if (rg.trim() === "") {
        mensagemErroRG.textContent = '';
        mensagemErroRG.classList.remove('error-message');
        mensagemEstado.textContent = ''; // Limpa mensagem de estado se o RG for vazio
    } else if (rg.length < 2) { // Se o RG tiver menos de 2 dígitos
        mensagemErroRG.textContent = 'Digite os dois primeiros dígitos do estado.';
        mensagemErroRG.classList.add('error-message');
        mensagemEstado.textContent = ''; // Limpa mensagem de estado se o RG for incompleto
    } else if (!regexRG.test(rg)) { // Se o RG tiver mais de 10 dígitos
        mensagemErroRG.textContent = 'Agora os Numeros do RG. Máximo 10 Numeros.';
        mensagemErroRG.classList.add('error-message');
        mensagemEstado.textContent = ''; // Limpa mensagem de estado se o RG for inválido
    } else {
        mensagemErroRG.textContent = '';
        mensagemErroRG.classList.remove('error-message');

        // Se o RG tiver pelo menos 2 dígitos, mostra o estado baseado nos dois primeiros dígitos
        var estado = rg.slice(0, 2);
        mensagemEstado.textContent = 'Estado: ' + estado; // Exibe o estado
    }
}



function validarDataNascimento(dataNascimento) {
    var mensagemErroData = document.getElementById('mensagemErroData');
    
    // Dividir a data de nascimento em ano, mês e dia
    var partesData = dataNascimento.split('-');
    var anoNascimento = parseInt(partesData[0]);
    var mesNascimento = parseInt(partesData[1]) - 1; // Mês é base zero (janeiro = 0)
    var diaNascimento = parseInt(partesData[2]);

    // Calcular a data atual
    var dataAtual = new Date();
    var anoAtual = dataAtual.getFullYear();
    var mesAtual = dataAtual.getMonth();
    var diaAtual = dataAtual.getDate();

    // Calcular a idade
    var idade = anoAtual - anoNascimento;
    
    // Ajustar a idade se o aniversário ainda não ocorreu este ano
    if (mesAtual < mesNascimento || (mesAtual === mesNascimento && diaAtual < diaNascimento)) {
        idade--;
    }

    // Verificar se a idade está dentro dos limites estabelecidos
    if (idade > 130 || idade < 0) {
        mensagemErroData.textContent = 'Por favor, insira uma data de nascimento válida.';
        mensagemErroData.classList.add('error-message');
        return; // Encerra a função se a idade estiver fora dos limites
    }

    // Verificar se o ano de nascimento não está no futuro
    if (anoNascimento > anoAtual) {
        mensagemErroData.textContent = 'Você não pode nascer no futuro.';
        mensagemErroData.classList.add('error-message');
        return; // Encerra a função se o ano de nascimento estiver no futuro
    }

    // Se todas as verificações passarem, limpa a mensagem de erro
    mensagemErroData.textContent = '';
    mensagemErroData.classList.remove('error-message');
}
