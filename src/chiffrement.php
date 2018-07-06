<?php

function chiffrementpattern($pattern, $n)
{
    for($i=0; strlen($pattern) > $i; $i++)
        {
            if(strlen(decbin(ord($pattern[$i]))) == 8){
                $binarymsg[] = decbin(ord($pattern[$i]));
            }
            elseif($pattern[$i] == " " || !ctype_alpha($pattern[$i])){
                if(strlen(decbin(ord($pattern[$i]))) < 7){
                    $binarymsg[] = "00" . decbin(ord($pattern[$i]));
                }
                elseif(strlen(decbin(ord($pattern[$i]))) < 8){
                    $binarymsg[] = "0" . decbin(ord($pattern[$i]));
                }
            }
            else{
                if(strlen(decbin(ord($pattern[$i]))) < 8){
                $binarymsg[] = "0" . decbin(ord($pattern[$i]));
                }
            }
        }
        $binarymsg = str_split(implode($binarymsg), $n);
        $endarray = array_pop($binarymsg);
        $missingchar =  $n - strlen($endarray);
        if($missingchar > 0)
        {
            while($missingchar != 0){
                $endarray .= "0" ;
                $missingchar--;
            }
            array_push($binarymsg, $endarray);
        }
        return $binarymsg;
}


//Chiffrement
function associateBinary($binarymsg)
{
    $crypt = array();
    // $GLOBAL['public_key'] = array(251,255,312,412,462,492,502,510);
     for($i = 0; $i != count($binarymsg) ;$i++)
     {
		 preg_match_all("([01])", $binarymsg[$i], $matches);
		 $cryptnb = 0;
		 $matches[0] = array_reverse($matches[0]);
             for($k = 0; $k != count($matches[0]); $k++)
             {
                if($matches[0][$k] == "1")
                {
					$cryptnb += $GLOBALS['public_key'][$k];
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


function help(){
    echo "\n1. Démarrer le programme\n

    Il faut se situer dans le dossier racine, et lancer la commande:\n
    
        php cryptoproject.php\n
    
    A partir de là 3 choix s’offrent a l’utilisateur: 1, 2 ,3 chacun correspond a une étape.\n
    
    \n
    2. Génération de la clef public\n
    
    Après avoir rentré le chiffre 1 dans le prompt, une suite super croissante vous est demandée, les éléments de la suite doivent êtres séparées par une virgules.\n
    
    Ensuite une suite super-croissante est demandé a l’utilisateur, si un caractère autre qu’un chiffre est entré il ne sera pas pris en compte. Si la suite n’est pas super-croissante une nouvelle entrée utilisateur est demandée jusqu’a ce que celle-ci respecte les critères mathématiques.\n
    
    Une fois la suite validée un nombre M est demandée, il faut que M soit plus grand que la somme des nombre de la suite super-croissante,  en cas d’erreur une nouvelle saisie sera redemandé automatiquement.\n
    
    Enfin il faut entrer N dont le PGCD par rapport a M doit être de 1, en cas d’erreur une nouvelle saisie sera redemandé automatiquement.\n
    
    Une fois la clef généré celle-ci est enregistrée dans une variable GLOBAL et ne pourra être réutilisé  si l’exécution du programme est interrompue.\n
    
    \n
    
    3. Chiffrer un message\n
    
    Après avoir rentré le chiffre 2 dans le prompt, si une suite super-croissante n’est pas présente elle est demandée l’utilisateur doit la rentrée (se référer au deuxième paragraphe du chapitre 2).\n
    
    Le message a crypté est ensuite demandée. \n
    
    Une fois que le message  est crypté il s’affiche a l’écran.\n
    
    
    \n
    
    
    4. Déchiffrer un message\n
    
    Afin de déchiffrer le message si il manque une suite super-croissante le programme demande de la rentrer\n
    ";
}

?>