<?php
// Conexão com o banco de dados
$servername = "127.0.0.1:3306";
$username = "root";
$password = "senhasua";
$database = "recuperacaosenha";

$conn = new mysqli($servername, $username, $password, $database); 

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processa os dados do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o CPF já existe na tabela Paciente
    $cpf = $_POST['cpf'];
    $check_query = "SELECT CPF FROM Paciente WHERE CPF = '$cpf'";
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
        $token= $token;

        // Insere os dados na tabela Paciente
        $sql = "INSERT INTO Paciente (Nome, Email, RG, DataNascimento, CPF, Sexo, CEP, Cidade, Estado, Logradouro, Numero, Complemento, Telefone, Telefone_Emergencial, token) 
                VALUES ('$nome', '$email', '$rg', '$data_nascimento', '$cpf', '$sexo', '$cep', '$cidade', '$estado', '$logradouro', '$numero', '$complemento', '$telefone', '$telefone_emergencia', '$token')";
        
        ini_set('SMTP', 'localhost');
        ini_set('smtp_port', '25');
        
        // Step 6: Send recovery email
        $subject = "Password Reset";
        $message = '
        <html>
        <head>
          <title>Password Reset</title>
          <style>
            .message {
              font-size: 16px;
              line-height: 1.5;
              font-family: Arial, sans-serif;
              color: #333333;
            }
            span{
              font-size: 20px;
              font-weight: bold;
              color: #ff0000;
            }
            
          </style>
        </head>
        <body>
        <div class="x">
        <h2 class="message">Account Creation</h2>
        <p class="message">Your account has been successfully created.</p>
        <p class="message">Please find your login details below:</p>
        <p class="message">Login:</strong>' .$email. '</p>
        <p class="message">CPF:</strong>' .$cpf. '</p>
        <p class="message">Password-Token:</strong>' .$token. '</p>
        
        <p class="message">For security reasons, we recommend changing your password after your first login.</p>
        <p class="message">If you have any questions or concerns, please feel free to contact us.</p>
        <p class="message">Regards,<br>Your Name</p>
    </div>
    
        </body>
        </html>
        ';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Your Name <your_email@example.com>' . "\r\n";

        if (mail($email, $subject, $message, $headers)) {
            echo "Recovery email sent successfully";
        } else {
            echo "Error sending recovery email";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $conn->error;
        }
    }
   
    
    // Step 5: Store the new token in the database
    #$sql_insert_token = "INSERT INTO paciente (senha) VALUES ('$token')";
    #$conn->query($sql_insert_token);
    
    
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
    <link rel="stylesheet" href="../styles/cadastroPaciente.css"> <!-- Crie um arquivo styles.css para suas regras de estilo -->
</head>
<body>

<div id="cadastro">
    <form class="card" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <div class="card-header">
            <h2>Cadastre-se</h2>
        </div>
        <div class="card-content">
            <div class="card-content-area">
                <label for="nome">Nome</label>
                <input grid-area="nome" type="text" id="nome" maxlength="50" name="nome" placeholder="Nome" class="rounded-border-light-pink" oninput="validarNome(this.value.trim())">               
                <div id="mensagemErroNome" class="error-message"></div>
            </div>
            
            <div class="card-content-area">
                <label for="email">E-mail</label>
                <input grid-area="email" type="email" id="email" maxlength="50" name="email" placeholder="Email" class="rounded-border-light-pink" oninput="validarEmail(this.value.trim())">                
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
                <label for="cpf">CPF</label>
                <input grid-area="cpf" type="text" id="cpf" maxlength="14" name="cpf" placeholder="CPF" class="rounded-border-light-pink" oninput="validarCPF(this.value.trim())">               
                <div id="mensagemErroCPF" class="error-message"></div>
            </div> 
            
            <div class="card-content-area">
                <label for="sexo">Sexo</label>
                <select grid-area="sexo"  id="sexo" name="sexo" class="rounded-border-light-pink">
                    <option value="masculino">Masculino</option>
                    <option value="feminino">Feminino</option>
                    
                </select>               
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
            
            <div class="telefonediv" grid-area="telefonediv">
                <div class="card-content-area">
                    <label for="telefone">Telefone</label>
                    <input type="tel" id="telefone" maxlength="15" grid-area="telefone" name="telefone" placeholder="Telefone" class="rounded-border-light-pink" oninput="formatarTelefone(this); validarTelefone(this.value.trim())">                
                    <div id="mensagemErroTelefone" class="error-message"></div>
                </div>
                

                <div class="card-content-area">
                    <label for="telefone-emergencia">Telefone de Emergência</label>
                    <input type="tel" id="telefone-emergencia"  grid-area="telefone2" maxlength="15" name="telefone-emergencia" placeholder="Telefone" class="rounded-border-light-pink" oninput="formatarTelefoneEmergencia(this); validarTelefoneEmergencia(this.value.trim())">                
                    <div id="mensagemErroTelefoneEmergencia" class="error-message"></div>
                </div>
            </div>
            
            
            

        </div>
        <div class="card-footer">
            <button id="enviarBtn" type="submit">Criar Conta</button>
            <div id="login"><p>Já tem uma conta? <a href="../php/login_paciente.php">Faça login</a></p></div>
        </div>
    </form>
</div>

<script defer src="../scripts/cadastroPaciente.js"></script> <!-- Crie um arquivo script.js para suas interações com JavaScript -->

</body>
</html>
