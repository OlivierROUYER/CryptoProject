<?php
include 'src/pubkey.php';
include 'src/chiffrement.php';
include 'src/decrypt.php';

starting_program();

function firstChoice($isinfunc){
        $pattern = readline("Entrez une suite super croissante :   \n");
       	preg_match_all("([0-9]+)", $pattern, $matches);
		if(count($matches[0]) == NULL || verifSuite($matches[0]) == 0)
		{
			echo "Erreur aucune clef ne peut être générée par la chaine rentrée   \n";
			return firstChoice();
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
		$GLOBALS['public_key'] = $pubkey;
		$GLOBALS['M'] = $M;
		$GLOBALS['E'] = $E;
		$GLOBALS['P'] = $P;
		$GLOBALS['privateKey'] = $matches[0];

		if ($isinfunc != 0)
			starting_program();
}


function secondChoice(){
	 //Enter the message to crypt
	 $binarymsg = array();
	 $pattern = readline("Entrez le message que vous souhaitez crypter : \n");

	 if(!isset($GLOBALS['public_key']))
	 {
		print("Aucune clef publique trouvé veuillez en entrée une (retour étape 1) : \n");
		// $GLOBALS['public_key'] = readline("Entrez une suite super croissante : \n");
		firstChoice(0);
	 }

	 $n = readline("Choisissez un nombre n compris entre 2 et " . count($GLOBALS['public_key']) ." : \n");

	 while($n > count($GLOBALS['public_key']) || $n < 2)
	 {
		 echo "\nErreur le nombre n ne correspond pas aux critères :/ \n";
		 $n = readline("Choisissez un nombre n compris entre 2 et " . count($GLOBALS['public_key']) ." : \n");

	 }

	 // Mise sous format de l'array en string
	 $binarymsg = chiffrementpattern($pattern, $n);
	 $crypt = associateBinary($binarymsg);
	 $GLOBALS['N'] = $n;
	 $GLOBALS['crypt_msg'] = $crypt;
	 echo "\nVotre message crypté est " . implode($crypt) . " et votre N est :" . $n . "\n";
	 starting_program();
}

function thirdChoice()
{
	$M = $GLOBALS['M'];
	$E = $GLOBALS['E'];
	$P = $GLOBALS['P'];
	$N = $GLOBALS['N'];
	$secret = $GLOBALS['privateKey'];
	$message = $GLOBALS['crypt_msg'];
	$D = inv_modulo($E, $M);

	$msgChanged = (changMessage($message, $D, $M));
	$S2 = permutePrivateKey($secret, $P);
	$equArray = equivalentBinaire($S2, $N);

	$tobeconvert = useBinEquivalence($msgChanged, $equArray, $N);
	echo "\nVotre message decrypté est '". convertToChar($tobeconvert) . "'\n\n";
}

function starting_program()
{
	echo "\n-------------------------------------------------\n";
	echo "\nBienvenu sur Crypto Program de Alexandre et Olivier, \nPour une aide quelconque veuillez taper --help dans le prompt \n\n";
	echo "Appuyez sur : \n 
	1 : Génération d'une clé publique \n
	2 : Chiffrement d'un message \n
	3 : Déchiffrement d'un message \n";
	$pattern = readline("\n	Entrez votre choix : ");
	switch($pattern)
	{
		case 1:
			firstChoice(1);
			break;
		case 2:
			secondChoice();
			break;
		case 3:
			thirdChoice();
			break;
		case "--help":
			echo "\n------------- voici de l'aide ----------- \n\n";
			break;
		default:
			echo "'". $pattern . "' N'est pas une entrer valide. Veuillez entrez '1', '2' ou '3' \n";
			starting_program();
	}
}

?>