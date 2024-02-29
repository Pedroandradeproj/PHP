<html>
    <body>
       
        <?php
        // Estruturas condicionais: Faça um programa PHP que determine se um número é positivo, negativo ou zero.
        // Função para determinar o sinal de um número
        function determinarSinal($numero) {
            if ($numero > 0) {
                echo $numero." é  positivo.";
            } elseif ($numero < 0) {
                echo $numero." é  negativo.";
            } else {
                echo $numero." número é zero.";
            }
        }
        
        // Número a ser verificado
        $numero = 10; // Você pode alterar o valor aqui para testar diferentes números
        
        // Chamada da função para determinar o sinal do número
        determinarSinal($numero);
        ?>
        
        
    </body>
</html>
