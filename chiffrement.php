<?php
function applyPermutation($input, $permutation) {
    $output = '';
    for ($i = 0; $i < 8; $i++) {
        $output .= $input[$permutation[$i] - 1];
    }
    return $output;
}

function inversePermutation($input, $permutation) {
    $output = '';
    for ($i = 0; $i < 8; $i++) {
        $output .= $input[$permutation[$i] - 1];
    }
    return $output;
}

function splitIntoBlocks($input) {
    $block1 = substr($input, 0, 4);
    $block2 = substr($input, 4, 4);
    return array($block1, $block2);
}

function permutationP($input) {
    $permutation = array(2, 0, 1, 3);
    $output = '';
    for ($i = 0; $i < 4; $i++) {
        $output .= $input[$permutation[$i]];
    }
    return $output;
}

function applyRound($blockG, $blockD, $key) {
    $D1 = permutationP($blockG) ^ $key;
    $G1 = $blockD ^ ($blockG | $key);
    return array($D1, $G1);
}

function encryptText($text, $permutation, $key1, $key2) {
   
    $textPermuted = applyPermutation($text, $permutation);
    

    list($G0, $D0) = splitIntoBlocks($textPermuted);
    

    list($D1, $G1) = applyRound($G0, $D0, $key1);
    
   
    list($D2, $G2) = applyRound($G1, $D1, $key2);
    
    $C = $G2 . $D2;
    
    
    $encryptedText = inversePermutation($C, $permutation);
    
    return $encryptedText;
}

// Example usage
$userPermutation = array(4, 6, 0, 2, 7, 3, 1, 5);
$userKey1 = "1010"; 
$userKey2 = "1100"; 
$userText = "11001100"; 

$encryptedText = encryptText($userText, $userPermutation, $userKey1, $userKey2);
echo "Encrypted Text: " . $encryptedText;
?>
