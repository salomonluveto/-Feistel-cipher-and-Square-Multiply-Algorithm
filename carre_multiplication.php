<?php

function squareAndMultiply($x, $b, $n) {
    $y = 1;
    $binaryB = decbin($b); // Représentation binaire de b
    $k = strlen($binaryB);
    
    for ($i = 0; $i < $k; $i++) {
        $y = ($y * $y) % $n; // Carré
        if ($binaryB[$i] == '1') {
            $y = ($y * $x) % $n; // Multiplication
        }
    }
    
    return $y;
}

// Entrées de l'utilisateur
$x = 5; 
$b = 13; 
$n = 23; 

// Calcul de (x^b) mod n en utilisant l'algorithme des carrés et des multiplications
$result = squareAndMultiply($x, $b, $n);
echo "Le résultat de ($x^$b) mod $n est : $result";
?>
