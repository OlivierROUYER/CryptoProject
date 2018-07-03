<?php

starting_program();


function starting_program(){
print("Bienvenu sur Crypto Program de Alexandre et Olivier, pour une aide quelconque veuillez taper --help dans le prompt \n");
while(true)
{
	$pattern = readline("Entrez une suite super croissante :   \n");
	preg_match_all("([0-9]+)", $pattern, $matches);
	if(count($matches[0]) == NULL){
	print("Erreur aucune clef ne peut être générée par la chaine rentrée   \n");
	}
	else
	{
	print_r($matches);
	}
}

}