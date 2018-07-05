<?php
include 'src/pubkey.php';
include 'src/chiffrement.php';

starting_program();

function firstChoice(){
        $pattern = readline("Entrez une suite super croissante :   \n");
       	preg_match_all("([0-9]+)", $pattern, $matches);
		if(count($matches[0]) == NULL)
		{
			echo "Erreur aucune clef ne peut être générée par la chaine rentrée   \n";
			firstChoice();
        }
        else
        {
			$M = getM($matches[0]);
			$E = getE($M);
			$intermediatekey = intermediateKey($matches[0], $E, $M);
			$pubkey = finalPubkey($intermediatekey);
			$P = permutation($intermediatekey, $pubkey);
			echo "\nFélicitation, votre clefs public est " . implode($pubkey) . " ! \n";
			echo "Et votre permutation est " . implode(" ", $P) . "\n\n";
		}
		//writeInfile($pubkey, "public_key");
		$GLOBAL['public_key'] = $pubkey;
		starting_program();
}


function secondChoice(){
	 //Enter the message to crypt
	 $binarymsg = array();
	 $pattern = readline("Entrez le message que vous souhaitez crypter : \n");
	 //Find n
	 if(!isset($GLOBAL['public_key']))
	 {
		print("Aucune clef publique trouvé veuillez en entrée une (retour étape 1) : \n");
		$GLOBAL['public_key'] = readline("Entrez une suite super croissante : \n");
	 }
	 $GLOBAL['public_key'] = array(251,255,312,412,462,492,502,510);
	 $n = readline("Choisissez un nombre n compris entre 2 et " . count($GLOBAL['public_key']) ." : \n");
	 if($n > count($_GLOBAL['public_key']) || $n < 2)
	 {
	 echo "Erreur le nombre n ne correspond pas aux critères !!!! \n";
	 secondChoice();
	 }

	 // Mise sous format de l'array en string
	 $binarymsg = chiffrementpattern($pattern, $n);
	 $crypt = associateBinary($binarymsg);
	 $GLOBAL['N'] = $n;
	 $GLOBAL['crypt_msg'] = $crypt;
}

function thirdChoice(){
	echo 3;
}

function starting_program()
{
	echo "Bienvenu sur Crypto Program de Alexandre et Olivier, \n pour une aide quelconque veuillez taper --help dans le prompt \n";
	echo "Appuyez sur : \n 
	1 : Génération d'une clé publique \n
	2 : Chiffrement d'un message \n
	3 : Déchiffrement d'un message \n";
	$array = array( 1 => "first", 2 => "second" , 3 => "third");
	$pattern = readline("\n	Entrez votre choix : ");
	if($pattern != ( 1 || 2 || 3)){
		echo "------------------------  MAUVAISE SAISIE !!!!! ----------------------------\n";
		starting_program();
	}
	$function = $array[$pattern]."Choice";
	$function();
}