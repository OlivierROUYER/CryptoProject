<?php

function chiffrementpattern($pattern, $n)
{
    //var_dump($pattern);
    for($i=0; strlen($pattern)>$i; $i++)
        {
            $binarymsg[] = "0" . decbin(ord($pattern[$i]));
        }
        // Mise sous format de l'array en string
        $binarymsg = str_split(trim(implode($binarymsg)), $n);
        $endarray = array_pop($binarymsg);
        $missingchar =  $n - strlen($endarray);
        if($missingchar > 0)
        {
            while($missingchar != 0){
                $endarray .= "0" ;
                $missingchar--;
            }
           // var_dump($endarray);
            array_push($binarymsg, $endarray);
        }
        return $binarymsg;
}
?>