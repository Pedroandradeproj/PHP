<html>
    <body>
       <?php
        // 8- Métodos: Crie uma programa em PHP que receba o valor de uma circunferência de um círculo. 
        // Implemente um método para calcular a área do círculo.

        function calcularAreaDoCirculo($raio) {
            // Calcula a área do círculo
            $area = M_PI * pow($raio, 2);// POW Ela recebe dois parâmetros: a base e a potência à qual a base será elevada
            return $area;
        }

        // Exemplo de uso:
        $raio = 2;
        $area = calcularAreaDoCirculo($raio);
        $area_arredondada = round($area, 2);//arremdodar 
        echo "A área do círculo com raio $raio é: $area_arredondada";
        ?>
    </body>
</html>
