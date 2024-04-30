<?php
session_start(); // Inicia a sessão para acessar o email armazenado

// Conexão com o banco de dados
$servername = "127.0.0.1:3306";
$username = "root";
$password = "@2003Andrade14201540";
$database = "recuperacaosenha";



$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o token do formulário
    $token = implode("", $_POST["token"]);

    // Obtém o email armazenado na sessão
    $email = $_SESSION["email"];

    // Consulta o banco de dados para verificar se o token existe para o email fornecido
    $sql_check_token = "SELECT * FROM Funcionario WHERE email='$email' AND SenhaToken='$token'";
    $result_check_token = $conn->query($sql_check_token);
    
    

    if ($result_check_token->num_rows > 0) {
        // Armazena o email na sessão para passar como parâmetro
        $_SESSION["email"] = $email;
        // Redireciona para a página de verificação de token
        echo "<script>alert('Token válido. Você pode prosseguir com a redefinição da senha.'); window.location.href = '../php/senha.php';</script>";
    } else {
        echo "<script>alert('Token inválido. Por favor, verifique o token e tente novamente.');</script>";
    }
    
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Token</title>
    <link rel="stylesheet" href="../styles/codigo1.css">
</head>
<body>
    <div id="codigo">
        <form class="card" method="post">
            <div class="card-header">
                <h2>Código de Verificação</h2>
            </div>
            <div class="password-container">
                <div class="codigo-inputs">
                    <?php
                    // Gera campos de entrada para o token
                    for ($i = 0; $i < 4; $i++) {
                        echo '<input type="text" name="token[]" maxlength="1" pattern="[0-9]" required>';
                    }
                    ?>
                    <span>---</span>
                    <?php
                    for ($i = 0; $i < 4; $i++) {
                        echo '<input type="text" name="token[]" maxlength="1" pattern="[0-9]" required>';
                    }
                    ?>
                </div>
                <span id="mensagemErroToken" class="error-message"></span>
            </div>
            <div class="card-footer">
                <button id="enviarBtn" type="submit">Confirmar</button>
            </div>
        </form>
    </div>
</body>
</html>