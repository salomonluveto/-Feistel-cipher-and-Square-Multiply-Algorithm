<?php

function permutation($input, $permutationOrder) {
    $output = '';
    for ($i = 0; $i < strlen($permutationOrder); $i++) {
        $output .= $input[$permutationOrder[$i]-1];
    }
    return $output;
}

function divideIntoBlocks($input) {
    $midpoint = strlen($input) / 2;
    $block1 = substr($input, 0, $midpoint);
    $block2 = substr($input, $midpoint);
    return array($block1, $block2);
}


function inversePermutation($input, $permutationOrder) {
    $output = '';
    for ($i = 0; $i < strlen($permutationOrder); $i++) {
        $output[$permutationOrder[$i]-1] = $input[$i];
    }
    ksort($output);
    return implode('', $output);
}


function main($input, $permutationOrder, $roundKeys) {
    // Application de la permutation initiale
    $permutedInput = permutation($input, $permutationOrder);
    
    // Division en deux blocs
    list($G2, $D2) = divideIntoBlocks($permutedInput);
    
 
    $G1 = permutation($D2 ^ $roundKeys[1], 2013);
    $D1 = $G2 ^ ($G1 | $roundKeys[1]);
    
   
    $G0 = permutation($D1 ^ $roundKeys[0], 2013);
    $D0 = $G1 ^ ($G0 | $roundKeys[0]);
    
    
    $N = $G0.$D0;
    
    
    $output = inversePermutation($N, $permutationOrder);
    
    return $output;
}

// Exemple d'utilisation
$input = "10101010"; 
$permutationOrder = "46027315"; 
$roundKeys = array("key1", "key2"); 

$result = main($input, $permutationOrder, $roundKeys);
echo "Sortie : Le texte clair N de longueur 8 : " . $result;
?>
