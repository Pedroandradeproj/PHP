<html>
    <body>
       <?php
        // 6- Vetores: Faça um programa PHP que calcule a média de um array de números.
        $vetor= [1,2,3,4,5];
        $media= 0;
        for($i=0;$i<count($vetor);$i++){
            $media += $vetor[$i];
        }
        echo "Media da array é = ".$media/5;
        ?>
    </body>
</html>