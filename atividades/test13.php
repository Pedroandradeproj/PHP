<html>
    <body>
       
        <?php
        //Matrizes: Escreva um programa PHP que verifique se uma matriz é simétrica ou não.
        function matrizSimetrica($matriz) {
            // Obtém o número de linhas e colunas da matriz
            $linhas = count($matriz);
            $colunas = count($matriz[0]);
        
            // Verifica se o número de linhas é igual ao número de colunas
            if ($linhas != $colunas) {
                return "A matriz não é quadrada, portanto não pode ser simétrica.";
            }
        
            // Verifica se a matriz é simétrica
            for ($i = 0; $i < $linhas; $i++) {
                for ($j = 0; $j < $colunas; $j++) {
                    // Compara cada elemento com o elemento correspondente na posição simétrica
                    if ($matriz[$i][$j] != $matriz[$j][$i]) {
                        return "A matriz não é simétrica.";
                    }
                }
            }
        
            // Se passou por todas as verificações, a matriz é simétrica
            return "A matriz é simétrica.";
        }
        
        // Exemplo de uso
        $matriz = array(
            array(1, 2, 3),
            array(2, 4, 5),
            array(3, 5, 6)
        );
        
        echo matrizSimetrica($matriz);
        ?>
        
    </body>
</html>
