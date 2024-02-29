<html>
    <body>
       
        <?php
        //Repetição: Escreva um programa PHP que imprima os primeiros 10 números da sequência de Fibonacci.
        $rep = 10;
        $fib = array(0, 1);

        for ($i = 0; $i < $rep; $i++) {
            $num = $fib[$i];
            $num1 = $fib[$i + 1];
            array_push($fib, $num + $num1);
        }

        print_r($fib);
            
        ?>
        
    </body>
</html>
