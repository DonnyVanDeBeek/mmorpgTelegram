<?php

include 'keyboard.php';

//La libreria si compone di due parti: il ButtonLine e la Keyboard.
//Un ButtonLine consiste in una linea di pulsanti appartenente alla tastiera.
//Il costruttore prende 0 o più stringhe/array di stringhe/bottoni come argomento:
//  ognuno degli argomenti apparirà come pulsante su una singola linea

$buttonline = new ButtonLine("Bottone 1");

//Invece di invocare 'new' è possibile richiamare la funzione 'as_button()' per creare un pulsante
$buttonline = as_button("Bottone 2", "Bottone 3");

//Una volta che un buttonline è stato creato, è possibile aggiungere altri pulsanti mediante il 
//  metodo push
$buttonline->push("Bottone 4");

//È anche possibile rimuovere un pulsante mediante 'remove'.
//Sia remove che push possono prendere qualsiasi numero di argomenti, stringhe, array e buttonlines
$buttonline->remove("Bottone 4");

//La rappresentazione della buttonline come strinfa è ottenuta mediante il comando dump
$rappr = $buttonline->dump();
print $rappr . "\n\n";

//In realtà, se l'obiettivo è stampare a schermo la rappresentazione, basta stampare l'oggetto
print $buttonline . "\n\n";

//I ButtonLines sono il cuore delle Keyboard.
//Un costruttore di Keyboard prende come argomento qualsiasi numero di argomenti di tipo stringa,
//  ButtonLine o array. Ogni elemento consisterà in una singola linea di tastiera.
$key = new Keyboard($buttonline, array("Arr 1", "Arr 2"), "String 1");

//È possibile aggiungere un nuovo elemento in coda alla tastiera mediante il metodo push, che prende
//  gli stessi argomenti disponibili per il costruttore
$key->push("Pushed", as_button("Inline A", "Inline B"));

//Anche la Keyboard dispone dei metodi dump e __toString
$rappr = $key->dump();
print $key . "\n\n";

//Dispone anche di un metodo remove, analogo a push.

//Infine, la Keyboard dispone di un attributo pubblico, "separator", che determina la stringa che separerà
//  i pulsanti.
//Il valore di default del separator è ", ".
$key->separator = ",\n";
print $key . "\n\n";


//Una possibile implementazione del menu di gioco:

$kMenuPrincipale = new Keyboard(
    as_button("Documento",          "Spostati"),
    as_button("Scheda personaggio", "Equipaggiamento"),
    as_button("Viaggio",            "Posizione"),
    as_button("Cerca rogne",        "Skills"),
    as_button("Usa Item"),     //o solo "Usa Item"
    as_button("Craft"),
    as_button("Vedi utenti"),
    as_button("Aggiungi punti")
);

$kMenuPrincipale->separator = ",\n";

print $kMenuPrincipale . "\n";
