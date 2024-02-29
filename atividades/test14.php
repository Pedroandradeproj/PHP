<html>
    <body>
       
        <?php
        // Métodos: Crie uma classe em PHP que represente uma calculadora. Implemente métodos para realizar
        // operações básicas como adição, subtração, multiplicação e divisão.
                
        class Calculadora {
            public function adicao($num1, $num2) {
                return $num1 + $num2;
            }

            public function subtracao($num1, $num2) {
                return $num1 - $num2;
            }

            public function multiplicacao($num1, $num2) {
                return $num1 * $num2;
            }

            public function divisao($num1, $num2) {
                // Verifica se o segundo número não é zero para evitar divisão por zero
                if ($num2 != 0) {
                    return $num1 / $num2;
                } else {
                    return "Erro: divisão por zero.";
                }
            }
        }

        // Exemplo de uso
        $calculadora = new Calculadora();

        // Operações
        echo "Adição: " . $calculadora->adicao(5, 3) . "\n";
        echo "Subtração: " . $calculadora->subtracao(8, 2) . "\n";
        echo "Multiplicação: " . $calculadora->multiplicacao(4, 6) . "\n";
        echo "Divisão: " . $calculadora->divisao(10, 2) . "\n";
        echo "Tentativa de divisão por zero: " . $calculadora->divisao(8, 0) . "\n";


        ?>
        
    </body>
</html>
