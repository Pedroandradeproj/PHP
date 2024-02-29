<html>
    <body>
       
        <?php
        //Funções: Crie uma função em PHP que verifique se uma palavra é um palíndromo.
        function verificarPalindromo($palavra) {
            // Remover espaços em branco e converter para minúsculas
            $palavra = strtolower(str_replace(' ', '', $palavra));
            
            // Inverter a palavra
            $palavraInvertida = strrev($palavra);
            
            // Verificar se a palavra invertida é igual à palavra original
            if ($palavra == $palavraInvertida) {
                return true; // É um palíndromo
            } else {
                return false; // Não é um palíndromo
            }
        }
        
        // Teste da função
        $palavra = "ovo";
        if (verificarPalindromo($palavra)) {
            echo "{$palavra} é um palíndromo.";
        } else {
            echo "{$palavra} não é um palíndromo.";
        }
        ?>
        
    </body>
</html>
