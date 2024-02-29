<?php

// Função para calcular a transposta de uma matriz
function calcularTransposta($matriz) {
    // Determina o número de linhas e colunas da matriz
    $linhas = count($matriz);
    $colunas = count($matriz[0]);

    // Inicializa uma matriz vazia para armazenar a transposta
    $transposta = array_fill(0, $colunas, array_fill(0, $linhas, 0));

    // Calcula a transposta
    for ($i = 0; $i < $linhas; $i++) {
        for ($j = 0; $j < $colunas; $j++) {
            // Troca as posições das linhas e colunas para calcular a transposta
            $transposta[$j][$i] = $matriz[$i][$j];
        }
    }

    return $transposta; // Retorna a matriz transposta
}

// Função para imprimir uma matriz
function imprimirMatriz($matriz) {
    // Percorre cada linha da matriz
    foreach ($matriz as $linha) {
        // Imprime os elementos da linha separados por espaço
        echo implode(" ", $linha) . "\n";
    }
}

// Exemplo de uso
$matriz = array(
    array(1, 2, 3),
    array(4, 5, 6),
    array(7, 8, 9)
);

echo "Matriz original:\n";
imprimirMatriz($matriz); // Imprime a matriz original

echo "\nTransposta:\n";
$transposta = calcularTransposta($matriz); // Calcula a transposta da matriz
imprimirMatriz($transposta); // Imprime a matriz transposta

?>
