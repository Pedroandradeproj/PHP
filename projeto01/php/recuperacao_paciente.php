<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email-recuperacao</title>
    <link rel="stylesheet" href="../styles/recuperacao.css"> <!-- Seu arquivo CSS personalizado -->
    
</head>
<body>
    <div id="cadastro">
        <form class="card"  method="post">
            <div class="card-content">
                <div class="card-header">
                    <h2>Recuperação de Senha</h2>
                </div>   
                
                <div class="card-content-area">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        Email: <input  type="text" name="email"><br>
                        <button id="enviarBtn" type="submit" value="Submit">Enviar</button> 
                    </form>    
                </div>
                <div id="mensagemErroEmail" class="error-message"></div>
            </div>
            
        </form>
    </div>   
    <script defer src="../scripts/recuperacao.js"></script>

    
</body>
</html>


<?php
// Conexão com o banco de dados
$servername = "127.0.0.1:3306";
$username = "root";
$password = "@2003Andrade14201540";
$database = "recuperacaosenha";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
echo "Conexão estabelecida com sucesso";


// Passo 1: Lidar com a submissão do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Passo 2: Validar o email
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de email inválido";
        exit;
    }
    
    // Passo 3: Verificar se o email já existe no banco de dados
    $sql_check_email = "SELECT * FROM paciente WHERE Email='$email'";
    $result_check_email = $conn->query($sql_check_email);
    
    // Verifica se o email existe na tabela
    if ($result_check_email->num_rows > 0) {
        // Se o email existe, gerar um novo token de recuperação
        $token = generateToken();
        
        // Atualizar o token no banco de dados
        $sql_update_token = "UPDATE paciente SET Token='$token' WHERE Email='$email'";
        
        if ($conn->query($sql_update_token) === TRUE) {
            echo "Token atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar token: " . $conn->error;
        }

        // Buscar nome e sexo do paciente
        $row = $result_check_email->fetch_assoc();
        $nome = $row["Nome"];
        $sexo = $row["Sexo"];
        
        // Determinar o tratamento de acordo com o sexo
        $tratamento = ($sexo == "masculino") ? "Sr." : "Sra.";
        
        // Construir a mensagem de recuperação de senha
        $mensagem = '
            <html>
            <head>
                <title>Redefinição de Senha</title>
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
                    <h2 class="message">Redefinição de Senha</h2>
                    <p class="message">Prezado(a) ' . $tratamento . ' ' . $nome . ',</p>
                    <p class="message">Recebemos uma solicitação para redefinir a senha da sua conta.</p>
                    <p class="message">Por favor, use o código abaixo para redefinir sua senha:</p>
                    <p class="message">Seu código de recuperação: <span>' . $token . '</span></p>
                    <p class="message">Após receber o código, visite o seguinte link para redefinir sua senha: <a href="http://localhost/novoprojeto/senha.html">Redefinir Senha</a></p>
                    <p class="message">Se você não solicitou esta recuperação, por favor, ignore este email.</p>
                    <p class="message">Cumprimentos,<br>ProzMed.</p>
                </div>
            </body>
            </html>
        ';

        // Enviar email de recuperação
        $assunto = "Redefinição de Senha";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Seu Nome <seu_email@example.com>";

        if (mail($email, $assunto, $mensagem, $headers)) {
            echo "Email de recuperação enviado com sucesso";
        } else {
            echo "Erro ao enviar email de recuperação";
        }
    } else {
        echo "Email não encontrado";
    }
}

function generateToken() {
    // Gerar um token aleatório de 8 dígitos
    $token = "";
    for ($i = 0; $i < 8; $i++) {
        $token .= mt_rand(0, 9);
    }
    return $token;
}

session_start(); // Inicia a sessão para acessar a variável $_SESSION

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Armazena o email inserido pelo usuário na sessão
    $_SESSION["email"] = $_POST["email"];

    // Redireciona para a página de verificação de token
    header("Location: ../php/codigo_paciente.php");
    exit; // Certifique-se de sair do script após o redirecionamento
}
?>
