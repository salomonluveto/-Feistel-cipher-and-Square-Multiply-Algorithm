<?php
function permutation($cle, $permutation) {
    $cle_permite = '';
    for ($i = 0; $i < strlen($permutation); $i++) {
        $cle_permite .= $cle[$permutation[$i]];
    }
    return $cle_permite;
}

function splitKey($cle) {
    $halfLength = strlen($cle) / 2;
    return [
        substr($cle, 0, $halfLength),
        substr($cle, $halfLength)
    ];
}

function applyXOR($k1, $k2) {
    return $k1 ^ $k2;
}

function applyAND($k1, $k2) {
    return $k1 & $k2;
}

function leftShift($cle, $shiftOrder) {
    return substr($cle, $shiftOrder) . substr($cle, 0, $shiftOrder);
}

function rightShift($cle, $shiftOrder) {
    return substr($cle, -$shiftOrder) . substr($cle, 0, -$shiftOrder);
}

$cle = "10101010"; 
$permutation = "65274130"; 
$shiftOrderK1 = 2;
$shiftOrderK2 = 1;

$cle_permite = permutation($cle, $permutation);
list($k1, $k2) = splitKey($cle_permite);
$k1 = bindec(leftShift(decbin(applyXOR(bindec($k1), bindec($k2))), $shiftOrderK1));
$k2 = bindec(rightShift(decbin(applyAND(bindec($k2), bindec($k1))), $shiftOrderK2));

echo "Sous-clé k1 : " . sprintf('%04d', decbin($k1)) . "\n";
echo "Sous-clé k2 : " . sprintf('%04d', decbin($k2)) . "\n";
?>
