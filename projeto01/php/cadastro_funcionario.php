<?php
// Conexão com o banco de dados
$servername = "127.0.0.1:3306";
$username = "root";
$password = "@2003Andrade14201540";
$database = "recuperacaosenha";

$conn = new mysqli($servername, $username, $password, $database); 

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processa os dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o CPF já existe na tabela 
    $cpf = $_POST['cpf'];
    $check_query = "SELECT CPF FROM Funcionario WHERE CPF = '$cpf'";
    $check_result = $conn->query($check_query);
    
    function gerarToken() {
        // Generate a random 8-digit token
        $token = "";
        for ($i = 0; $i < 8; $i++) {
            $token .= mt_rand(0, 9);
        }
        return $token;
    }
     
    // Step 4: Generate new recovery token
    $token = gerarToken();

    if ($check_result->num_rows > 0) {
        echo "Erro ao inserir dados: CPF já cadastrado.";
    } else {
        // Se o CPF não estiver cadastrado, prossegue com a inserção dos dados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $rg = $_POST['rg'];
    $data_nascimento = $_POST['data-nascimento'];
    $sexo = $_POST['sexo'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $telefone = $_POST['telefone'];
    $telefone_emergencia = $_POST['telefone-emergencia'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo']; // Adicionando o campo Cargo
    $registro = $_POST['registro']; // Novo campo para CRM ou COREN
    $tipo_registro = $_POST['tipo_registro']; // Novo campo para selecionar o tipo de registro

    // Insere os dados na tabela Funcionario
    $sql = "INSERT INTO Funcionario (Nome, Email, RG, DataNascimento, CPF, Sexo, CEP, Cidade, Estado, Logradouro, Numero, Complemento, Telefone, Telefone_Emergencial, Senha, SenhaToken, Cargo, registro, tipo_registro) 
    VALUES ('$nome', '$email', '$rg', '$data_nascimento', '$cpf', '$sexo', '$cep', '$cidade', '$estado', '$logradouro', '$numero', '$complemento', '$telefone', '$telefone_emergencia', '$senha', '$token', '$cargo', '$registro', '$tipo_registro')";

    if ($conn->query($sql) === TRUE) {
        // Step 6: Send recovery email
        // Código para enviar e-mail de recuperação aqui...
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $conn->error;
    }



    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se - Seu Projeto</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles/cadastro.css"> <!-- Crie um arquivo styles.css para suas regras de estilo -->
    
</head>
<body>


<div id="cadastro">
    <form class="card" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="card-header">
            <h2>Cadastre-se</h2>
        </div>
        <div class="card-content">
            <div class="card-content-area">
                <label for="nome">Nome / Nome Social</label>
                <input type="text" grid-area="nome" id="nome" maxlength="50" name="nome" placeholder="Nome" class="rounded-border-light-pink" oninput="validarNome(this.value.trim())">               
                <div id="mensagemErroNome" class="error-message"></div>
            </div>
            
            <div class="card-content-area">
                <label for="email">E-mail</label>
                <input type="email" grid-area="email" id="email" maxlength="50" name="email" placeholder="Email" class="rounded-border-light-pink" oninput="validarEmail(this.value.trim())">                
                <div id="mensagemErroEmail" class="error-message"></div>
            </div>
            

            <div class="card-content-area">
                <label for="rg">Número de Identidade (RG)</label>
                <input type="text" grid-area="rg" id="rg" maxlength="20" name="rg" placeholder="RG" class="rounded-border-light-pink" oninput="formatarRG(this); validarRG(this.value.trim())">               
                <div id="mensagemErroRG" class="error-message"></div>
            </div>
            
            <div class="card-content-area">
                <label for="data-nascimento">Data de Nascimento</label>
                <input  grid-area="data" type="date" id="data-nascimento" name="data-nascimento" placeholder="Data de Nascimento" class="rounded-border-light-pink" >    
                <div id="mensagemErroData" class="error-message"></div>   
            </div>

            <div class="card-content-area">
                <label for="cargo">Selecione um Cargo ou Função:</label>
                <select grid-area="cargo" id="cargo" name="cargo" class="rounded-border-light-pink">
                    <option value="" selected disabled>Escolha uma opção</option>
                    <option value="Médico">Médico</option>
                    <option value="Enfermeiro">Enfermeiro</option>
                    <option value="Técnico em Enfermagem">Técnico em Enfermagem</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            

            <div class="card-content-area">
                <label for="sexo">Sexo</label>
                <select grid-area="sexo" id="sexo" name="sexo" class="rounded-border-light-pink">
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    
                </select>               
            </div>

            <div class="card-content-area">
                <label for="registro">Número de Registro Profissional</label>
                <input type="text" grid-area="registro" maxlength="10" id="registro" name="registro" placeholder="Número de Registro Profissional" class="rounded-border-light-pink">               
            </div>

            <div class="card-content-area">
                <label for="tipo_registro">Tipo de Registro</label>
                <select grid-area="tipo_registro" id="tipo_registro" name="tipo_registro" class="rounded-border-light-pink">
                    <option value="crm">CRM</option>
                    <option value="coren">COREN</option>
                </select>
            </div>


            <div class="card-content-area">
                <label for="cpf">CPF</label>
                <input type="text" grid-area="cpf" id="cpf" maxlength="14" name="cpf" placeholder="CPF" class="rounded-border-light-pink" oninput="validarCPF(this.value.trim())">               
                <div id="mensagemErroCPF" class="error-message"></div>
            </div>
            

            <div class="card-content-area">
                <label for="cep">CEP</label>
                <input type="text" grid-area="cep" id="cep" maxlength="9" name="cep" placeholder="CEP" class="rounded-border-light-pink" onblur="buscarEnderecoPorCEP(this.value.trim())">               
            </div>
            
            
            <div class="card-content-area">
                <label for="cidade">Cidade</label>
                <input type="text" grid-area="cidade" id="cidade" name="cidade" placeholder="Cidade" class="rounded-border-light-pink">               
            </div>
            
            <div class="card-content-area">
                <label for="estado">Estado</label>
                <input type="text" grid-area="estado" id="estado" name="estado" placeholder="Estado" class="rounded-border-light-pink">               
            </div>

            <div class="card-content-area">
                <label for="logradouro">Logradouro</label>
                <input type="text" grid-area="logradouro" id="logradouro" name="logradouro" placeholder="Logradouro" class="rounded-border-light-pink">               
            </div>
            
            <div class="card-content-area">
                <label for="numero">Número</label>
                <input type="text" grid-area="numero" id="numero" name="numero" placeholder="Número" class="rounded-border-light-pink">               
            </div>
            
            <div class="card-content-area">
                <label for="complemento">Complemento</label>
                <input type="text" grid-area="complemento" id="complemento" name="complemento" placeholder="Complemento" class="rounded-border-light-pink">               
            </div>
            
            

            <div class="card-content-area">
                <label for="telefone">Telefone</label>
                <input type="tel" grid-area="telefone" id="telefone" maxlength="15" name="telefone" placeholder="Telefone" class="rounded-border-light-pink" oninput="formatarTelefone(this); validarTelefone(this.value.trim())">                
                <div id="mensagemErroTelefone" class="error-message"></div>
            </div>
            

            <div class="card-content-area">
                <label for="telefone-emergencia">Telefone de Emergência</label>
                <input type="tel" grid-area="telefone2" id="telefone-emergencia" maxlength="15" name="telefone-emergencia" placeholder="Telefone" class="rounded-border-light-pink" oninput="formatarTelefoneEmergencia(this); validarTelefoneEmergencia(this.value.trim())">                
                <div id="mensagemErroTelefoneEmergencia" class="error-message"></div>
            </div>
            
            
            <div class="senhadiv" grid-area="senhadiv" >
                <div class="card-content-area">
                    <div class="password-container">
                        <label for="senha">Senha</label>
                        <input type="password" grid-area="senha" id="senha" maxlength="20" name="senha" placeholder="Senha" class="rounded-border-light-pink" oninput="validarSenha(this.value)">
                        <span class="toggle-password" onclick="togglePasswordVisibilityCadastro()">
                            <span id="visibilityIconCadastro" class="material-symbols-outlined">visibility</span>
                        </span>
                    </div>
                    <div id="mensagemErroTamanho" class="error-message"></div>
                    <div id="mensagemErroMaiuscula" class="error-message"></div>
                    <div id="mensagemErroEspecial" class="error-message"></div>
                </div>
                
            
                
                <div class="card-content-area">
                    <div class="password-container">
                        <label for="confirmar-senha">Confirme a senha</label>
                        <input type="password" grid-area="senha2" id="confirmar-senha" name="confirmar-senha" maxlength="20" placeholder="Confirme a senha" class="rounded-border-light-pink" oninput="validarConfirmarSenha(this.value, senha.value)">
                        <span class="toggle-password" onclick="toggleConfirmarSenhaVisibilityCadastro()">
                            <span id="visibilityIconConfirmarCadastro" class="material-symbols-outlined">visibility</span>
                        </span>
                    </div>
                    <div id="mensagemErroConfirmarSenha" class="error-message"></div>
                </div>
            </div>
    

        </div>
        <div class="card-footer">
        <button id="enviarBtn" type="submit">Criar Conta</button>
            <div id="login"><p>Já tem uma conta? <a href="login_funcionario.php">Faça login</a></p></div>

        </div>
       
        
        <div grid-area="espaço"></div>
    </form>
</div>
<script defer src="../scripts/cadastroFuncionario.js"></script> <!-- Crie um arquivo script.js para suas interações com JavaScript -->

</body>
</html>
