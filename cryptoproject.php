<?php
include 'src/pubkey.php';

starting_program();

function firstChoice(){
        $pattern = readline("Entrez une suite super croissante :   \n");
       	preg_match_all("([0-9]+)", $pattern, $matches);
		if(count($matches[0]) == NULL)
		{
			print("Erreur aucune clef ne peut être générée par la chaine rentrée   \n");
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
		$_SESSION['public_key'] = $pubkey;
		starting_program();
}


function secondChoice(){
	 //Enter the message to crypt
	 $binarymsg = array();
	 $pattern = readline("Entrez le message que vous souhaitez crypter : \n");
	 //Find n
	 /*if(is_null($_SESSION['public_key']))
	 {
		print("Aucune clef publique trouvé veuillez en entrée une (retour étape 1) : \n");
		firstChoice();
	 }*/
	 $_SESSION['public_key'] = "fromage de bite";
	 $n = readline("Choisissez un nombre n compris entre 2 et " . strlen($_SESSION['public_key']) ." : \n");
	 if($n > strlen($_SESSION['public_key']) || $n < 2)
	 {
	 print("Erreur le nombre n ne correspond pas aux critères !!!! \n");
	 secondChoice();
	 }
	 //Convertion en binaire
	 for($i=0; strlen($pattern)>$i; $i++)
	 {
    	 $binarymsg[] = decbin(ord($pattern[$i]));
	 }
	 // Mise sous format de l'array en string
	 $binarymsg = implode('',$binarymsg);
	 //print_r($binarymsg);
	 $binarymsg = trim($binarymsg);
	 $binarymsg = wordwrap($binarymsg, $n, ' ');
	 print($binarymsg);
}

function thirdChoice(){
	echo 3;
}

function starting_program()
{
	print("Bienvenu sur Crypto Program de Alexandre et Olivier, \n pour une aide quelconque veuillez taper --help dans le prompt \n");
	print("Appuyez sur : \n 
	1 : Génération d'une clé publique \n
	2 : Chiffrement d'un message \n
	3 : Déchiffrement d'un message \n");
	$array = array( 1 => "first", 2 => "second" , 3 => "third");
	$pattern = readline("\nEntrez votre choix : ");
	$function = $array[$pattern]."Choice";
	$function();
}