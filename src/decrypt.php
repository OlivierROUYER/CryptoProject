<?php

include 'math.php';

$secret = [1,2,5,10,20,50,100,200];
$E = 255;
$M = 512;
$P = [2,8,1,7,6,5,4,3];
$N = 6;
$message = [774,563,663,563,774,312,1025,774,968,804,312];
$D =  inv_modulo($E, $M);


function change1($message, $D, $M)
{
    foreach($message as &$value)
    {
        $value = modulo(($value * $D), $M);
    }
    unset($value);
    return $message;
}

function permutation2($secret, $P)
{
    $S2 = [];
    $i = 0;
    foreach($P as $value)
    {
        $tmp = $value => $secret[$i];
        array_push($S2, $tmp);
        $i++;
    }
    var_dump($S2);
}

permutation2($secret, $P);

?>