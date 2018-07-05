<?php

// include 'math.php';

// $secret = [1,2,5,10,20,50,100,200];
// $E = 255;
// $M = 512;
// $P = [2,8,1,7,6,5,4,3];
// $N = 6;
// $message = [774,563,663,563,774,312,1025,774,968,804,312];
// $D =  inv_modulo($E, $M);


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

function useBinEquivalence($msgChanged, $equArray, $N)
{
    krsort($equArray);
    $binaryArray = array();
    foreach($msgChanged as $msg)
    {
        $bin = NULL;
        foreach($equArray as $key => $value)
        {
            if(($msg - $key) >= 0)
            {              
                $msg = $msg - $key;
                $value = intval($value);
                
                $bin += bindec($value);
            }           
            if($msg == 0)
            {
                $bin = decbin($bin);
                $decal = $N - strlen($bin);
                $tmp = NULL;
                while ($decal > 0)
                {
                    $tmp = $tmp . "0"; 
                    $decal -= 1;
                }
                $bin = $tmp . $bin;
                array_push($binaryArray, $bin);
                break;
            }
        }
    }
        return $binaryArray;
}

function convertToChar($binaryArray)
{
    $binaryArray = implode($binaryArray);
    $binaryArray = str_split($binaryArray, 8);
    if (modulo(strlen(end($binaryArray)), 8) != 0)
        array_pop($binaryArray);

    $char = NULL;
    foreach($binaryArray as $bin)
    {
        
        $char .= chr(bindec($bin));
        
    }
    return $char;
}

// $msgChanged = (changMessage($message, $D, $M));
// $S2 = permutePrivateKey($secret, $P);
// $equArray = equivalentBinaire($S2, $N);

// $tobeconvert = useBinEquivalence($msgChanged, $equArray, $N);
// convertToChar($tobeconvert);

?>