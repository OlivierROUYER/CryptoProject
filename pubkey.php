<?php


$array = [1, 2, 5, 20, 50, 100];

function getM($array)
{
    $minM = array_sum($array);
    $M = readline("Entrez M : ");
    if($M <= $minM)
    {
        echo "veuillez entrer un entier plus grand que la somme des valeurs de votre suite \n";
        getM($array);
    }
}

function my_modulo($a, $b)
{
    
}

getM($array);

?>