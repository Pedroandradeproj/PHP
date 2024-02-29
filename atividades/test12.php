<html>
    <body>
       
        <?php
        // Vetores: Faça um programa PHP que encontre o segundo maior elemento em um array
        function segundoMaior($array) {
            // Verifica se o array tem pelo menos dois elementos
            if (count($array) < 2) {
                return "O array precisa ter pelo menos dois elementos.";
            }
        
            // Ordena o array em ordem decrescente
            rsort($array);
        
            // Retorna o segundo elemento do array ordenado
            return $array[1];
        }
        
        // Exemplo de uso
        $array = [5, 2, 9, 11, 3];
        echo "O segundo maior elemento é : " . segundoMaior($array);
        ?>
        
    </body>
</html>
