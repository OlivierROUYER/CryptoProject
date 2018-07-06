<?php
include 'math.php';

function verifSuite($array)
{
    $tmp = 0;
    foreach($array as $value)
    {
        if ($value < $tmp)
        {
            echo "\nVeuillez entrer une suite super-croissante\n";
            return 0;
        }
        $tmp += $value;  
    }
    return 1;
}

function getM($array)
{
    $minM = array_sum($array);
    $M = readline("Entrez M : ");
    if($M <= $minM)
    {
        echo "veuillez entrer un entier plus grand que la somme des valeurs de votre suite \n\n";
       return getM($array);
    }
    return $M;
}

function getE($M)
{
    $E = readline("Entrez E : ");
    if($E >= $M)
    {
        echo "E doit être plus petit que " . $M . "\n";
        return getE($M);
    }
    elseif(pgcd($M, $E) != 1)
    {
        echo "le PGCD de M et E doit être égal à 1 \n";
        return getE($M);
    }
    else
        return $E;
}

function intermediateKey($array, $E, $M)
{
    foreach ($array as &$value) {
        $value = modulo(($value * $E), $M); //coder son modulo c'est propre de ouf dans le code ouai ouai
    }
    unset($value);
    return $array;
}

function finalPubkey($array)
{
    sort($array, SORT_NUMERIC);
    return $array;
}


function permutation($intermediateKey, $publicKey)
{
    $P = [];
    foreach($intermediateKey as $value)
    {
        $i = 0;

        while($value != $publicKey[$i])
        {
            $i++;
        }
        array_push($P, $i + 1);
    }
    return $P;
}

?>