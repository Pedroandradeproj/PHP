<?php
session_start(); // Inicia a sessão para acessar o email armazenado

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se as senhas fornecidas correspondem
    if ($_POST['senha'] === $_POST['confirmar-senha']) {
        // Se as senhas coincidirem, você pode prosseguir com o processo de redefinição da senha
        
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

        // Recupera o email do funcionário do formulário
        $email = $_POST['email'];

        // Nova senha
        $nova_senha = $_POST['senha'];

        // Hash da nova senha (recomendado para armazenamento seguro da senha)
        $hash_senha = ($nova_senha);

        // Atualiza a senha no banco de dados
        $sql = "UPDATE Funcionario SET Senha = '$hash_senha' WHERE Email = '$email'";

        if ($conn->query($sql) === TRUE) {
            echo "Senha atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar a senha: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "As senhas não coincidem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="../styles/senha.css"> <!-- Seu arquivo CSS personalizado -->
</head>
<body>
    <div id="cadastro">
        
        <form class="card" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="card-header">
                <h2>Redefinir Senha</h2>
            </div>
            <div class="card-content">
                <div class="card-content-area">
                    <div class="password-container">
                        <label for="senha">Nova Senha</label>
                        <input type="password" id="senha" maxlength="20" name="senha" placeholder="Senha" class="rounded-border-light-pink" required>
                        <span class="toggle-password" onclick="togglePasswordVisibilityCadastro()">
                            <span id="visibilityIconCadastro" class="material-symbols-outlined">visibility</span>
                        </span>
                    </div>
                </div>
                <div id="mensagemErroTamanho" class="error-message"></div>
                <div id="mensagemErroMaiuscula" class="error-message"></div>
                <div id="mensagemErroEspecial" class="error-message"></div>
                
                <div class="card-content-area">
                    <div class="password-container">
                        <label for="confirmar-senha">Confirme a senha</label>
                        <input type="password" id="confirmar-senha" name="confirmar-senha" maxlength="20" placeholder="Confirme a senha" class="rounded-border-light-pink" required>
                        <span class="toggle-password" onclick="toggleConfirmarSenhaVisibilityCadastro()">
                            <span id="visibilityIconConfirmarCadastro" class="material-symbols-outlined">visibility</span>
                        </span>
                    </div>
                </div>
                <div id="mensagemErroConfirmarSenha" class="error-message"></div>
            </div>
            <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>"> <!-- Campo oculto para armazenar o email -->
            <div class="card-footer">
                <button id="enviarBtn" type="submit">Logar</button>
            </div>
        </form>
    </div>
    
    
    <script defer src="../scripts/senha.js"></script> <!-- Seu arquivo JavaScript personalizado -->
</body>
</html>
