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


//Chiffrement
function associateBinary($binarymsg)
{
    $crypt = array();
    $GLOBAL['public_key'] = array(251,255,312,412,462,492,502,510);
     for($i = 0; $i != count($binarymsg) ;$i++)
     {
		 preg_match_all("([01])", $binarymsg[$i], $matches);
		 $cryptnb = 0;
		 //var_dump($_GLOBAL['public_key']);
		 $matches[0] = array_reverse($matches[0]);
             for($k = 0; $k != count($matches[0]); $k++)
             {
                if($matches[0][$k] == "1")
                {
					$cryptnb += $_GLOBAL['public_key'][$k];
					//var_dump($matches[0]);
					//print($k . "   " . $_GLOBAL['public_key'][$k] . "\n");
				}
			 }
		array_push($crypt, $cryptnb);
     }
     return $crypt;
}



//Sauvegarde dans le fichier save
function writeInfile($pattern, $descripiton){
        $filename = '../save.txt';
        //$pattern += " ,";
        if(is_array($pattern)){
            $pattern = implode($pattern);
        }
        $description += $pattern . "\n"; 

        if (is_writable($filename)) {
        if (!$handle = fopen($filename, 'a')) {
                echo "Impossible d'ouvrir le fichier ($filename)\n";
                exit;
            }

            if (fwrite($handle, $pattern) === FALSE) {
                echo "Impossible d'écrire dans le fichier ($filename)\n";
                exit;
            }

            echo "L'écriture de ($pattern) dans le fichier ($filename) a réussi\n";

            fclose($handle);

        } else {
            echo "Le fichier $filename n'est pas accessible en écriture.\n";
        }
}

?>