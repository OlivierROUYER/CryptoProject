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
			echo "votre clefs public à bien été généré !\n\n";
		}
		starting_program();
		return $pubkey;
}

function secondChoice(){
	echo 2;
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
	$pattern = readline("Entrez votre choix : ");
	$function = $array[$pattern]."Choice";
	$function();
}