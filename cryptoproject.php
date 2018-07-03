<?php

starting_program();

function firstChoice(){
while(true){
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


function secondChoice(){
print("2");
}

function thirdChoice(){
print("3");
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