<html>
    <body>
       <?php
        // 7- Matrizes: Escreva um programa PHP para calcular e imprimir a transposta de uma matriz.
        $matris = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ];
        $a=0;
        $b=1;
        $c=2;     
                   
            $matris[$b][0]-=2; 
            $matris[$c][0]-=4; 
            $matris[$c][1]-=2; 

            $matris[$b][2]+=2; 
            $matris[$a][1]+=2; 
            $matris[$a][2]+=4; 


        
        // Impressão da matriz transposta
        for ($i = 0; $i < count($matris); $i++) {
            echo "<br>";
            for ($j = 0; $j < count($matris[$i]); $j++) {
                echo $matris[$i][$j] . " ";
            }
        }
        ?>
    </body>
</html>