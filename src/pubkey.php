<?php
include 'math.php';

function getM($array)
{
    $minM = array_sum($array);
    $M = readline("Entrez M : ");
    if($M <= $minM)
    {
        echo "veuillez entrer un entier plus grand que la somme des valeurs de votre suite \n";
        getM($array);
    }
    return $M;
}

function getE($M)
{
    $E = readline("Entrez E : ");
    if($E >= $M)
    {
        echo "E doit être plus petit que " . $M . "\n";
        getE($M);
    }
    elseif(pgcd($M, $E) != 1)
    {
        echo "le PGCD de M et E doit être égal à 1 \n";
        getE($M);
    }
    else
        return $E;
}

function finalPubkey($array, $E, $M)
{
    foreach ($array as &$value) {
        $value = modulo(($value * $E), $M); //coder son modulo c'est propre de ouf dans le code ouai ouai
    }
    unset($value);
    sort($array, SORT_NUMERIC);
    return $array;
}

?>