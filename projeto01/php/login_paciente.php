<?php
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtém os dados do formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['password'];

    // Verifica se o usuário existe no banco de dados
    $query = "SELECT * FROM Paciente WHERE (CPF = '$usuario' or Email = '$usuario') AND token = '$senha'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Usuário autenticado com sucesso
        $row = $result->fetch_assoc();
        $nome = $row['Nome'];
        $sexo = $row['Sexo'];

        // Define o pronome de tratamento com base no sexo
        $pronome = ($sexo == 'masculino') ? 'Sr.' : 'Sra.';

        // Mensagem personalizada com o pronome de tratamento
        $mensagem = "Prezado $pronome $nome, você solicitou a recuperação de senha. Se não foi você, por favor, ignore este email.";

        // Envio do email
        $subject = "Recuperação de Senha";
        $message = "
            <html>
            <head>
              <title>Recuperação de Senha</title>
            </head>
            <body>
              <p>$mensagem</p>
              <p>Se não foi você, clique <a href='http://exemplo.com/denegaracesso'>aqui</a> para negar acesso à sua conta.</p>
              <p>Cumprimentos,<br>ProzMed</p>
            </body>
            </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= 'From: ProzMed <noreply@prozmed.com>' . "\r\n";

        // Função de envio de email
        mail($row['Email'], $subject, $message, $headers);

        // Redirecionamento para página secreta
        $_SESSION['usuario'] = $usuario;
        header("Location: pagina_secreta.php");
        exit(); // Importante: encerrar o script após o redirecionamento
    } else {
        // Usuário ou senha incorretos
        echo "Usuário ou senha incorretos.";
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Projeto</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../styles/login1.css"> <!-- Crie um arquivo styles.css para suas regras de estilo -->
    
    <script defer src="../scripts/login.js"></script> <!-- Crie um arquivo script.js para suas interações com JavaScript -->
</head>
<body>

<div id="login">

        <form class="card" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="card-header">
                <h2>Login</h2>
            </div>

            <div class="card-content">

                <div class="card-content-area">
                    <label for="usuario">Usuário (CPF ou E-mail)</label>
                    <input type="text" id="usuario" name="usuario" autocomplete="off" onchange="formatarCampo()">
                </div>

                <div class="card-content-area">
                    <label for="password">Senha</label>
                    <div class="password-input-container">
                        <input type="password" id="password" name="password" autocomplete="off" maxlength="20">
                        <span class="password-toggle" onclick="togglePasswordVisibility()">
                            <span id="visibilityIcon" class="material-symbols-outlined">visibility</span>
                        </span>
                    </div>
                </div>
                
            </div>

            <div class="card-footer">
                <input type="submit" value="Login" class="submit">
                <div class="grid">
                    <a href="../php/cadastro_paciente.php" class="cadastre_link">Cadastre-se!</a>
                    <a href="../php/recuperacao_paciente.php" class="esqueceusenha">Esqueceu a Senha</a>
                </div>
            </div>

        </form>

    </div>

</body>
</html>
