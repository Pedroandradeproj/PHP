<html>
    <body>
    <!-- 5- Funções: Crie um programa PHP que calcule e imprima a soma de dois números usando uma função. -->
        <?php
        function soma($a, $b) {
            $resultado = $a + $b;
            return "Resultado de ".$a."+".$b."= ".$resultado;
        }
        echo soma(3,5)
        ?>
    </body>
</html>