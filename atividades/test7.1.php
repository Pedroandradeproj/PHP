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
        $simp=1;
        $neg=0;
                   
        for($j =0; $j < 2; $j++){

            $matris[$a][1]+=2*$simp;
            $matris[$a][2+$neg]+=4*$simp;
            $matris[$b][2+$neg]+=2*$simp; 
            $a+=2;
            $simp*=-1;
            $neg+=-2;

        }
        
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