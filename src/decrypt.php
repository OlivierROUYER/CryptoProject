<?php

include 'math.php';

$secret = [1,2,5,10,20,50,100,200];
$E = 255;
$M = 512;
$P = [2,8,1,7,6,5,4,3];
$N = 6;
$message = [774,563,663,563,774,312,1025,774,968,804,312];
$D =  inv_modulo($E, $M);
$N = 6;


function changMessage($message, $D, $M) 
{
    foreach($message as &$value)
    {
        $value = modulo(($value * $D), $M);
    }
    unset($value);
    return $message;
}

function permutePrivateKey($secret, $P)
{
    $tmp = [];
    $S2 = [];
    $tmp = array_combine($P, $secret); //crée un tableau assoc avec P et la clefs secrete

    for ($i = 1; $i <= count($P) ; $i++)
    {
        array_push($S2, $tmp[$i]);
    }
    return $S2;
}

function equivalentBinaire($S2permuted, $N) //donne un equialent binaire à S2 permuted
{
    $array = [];
    $equiv = $N;
    $index = 0;
    for ($i = 0; $i < $N; $i++)
    {
        $tmp = "";
        for ($j = 0; $j < $N; $j++)
        {
            if ($j == $equiv - 1)
                $tmp .= "1";
            else   
                $tmp .= "0";
        }
        //array_push($array, array($S2permuted[$index] => $tmp));
        $array += [$S2permuted[$index] => $tmp];
       $index++;
       $equiv = $equiv - 1;
    }
    return $array;
}

// function useBinEquivalence($msgChanged, $equArray)
// {
//     var_dump($equArray);
//     krsort($equArray);
//     var_dump($equArray);
//     $binaryArray = array();
//     $equArray = array_reverse($equArray);
//     foreach($msgChanged as $msg)
//     {
//         for($i= 0; count($equArray) != $i; $i++ ){
//             print("eqrray : " . key($equArray[$i]) . "\n");
//             if($msg - $equArray[$i] > 0 || $msg - $equArray[$i] == 0){
//                  $msg -= $equArray[$i];
//                  print($i . ": msg " . $msg . "\n");
//     //            $binaryArray += [$msg => $equArray[$i]];
//              }
//          }
//      }
//     //var_dump($binaryArray);
// }


function useBinEquivalence($msgChanged, $equArray)
{
    krsort($equArray);
    $binaryArray = [];
    var_dump($equArray);
    foreach($msgChanged as $msg)
    {
        foreach($equArray as $key => $value)
        {
            $bin = NULL;
            if(($msg - $key) >= 0)
            {              
                $msg = $msg - $key;
                // array_push($binaryArray, array($value));
                
            }           
            elseif($msg == 0)
            {
                echo $msg . "moustafa ----------\n";
                break;
            }
        }    
    }
    var_dump($binaryArray);
}

$msgChanged = (changMessage($message, $D, $M));
$S2 = permutePrivateKey($secret, $P);
$equArray = equivalentBinaire($S2, $N);

useBinEquivalence($msgChanged, $equArray);

?>