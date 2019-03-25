<?php
	//[NPC ESPLORAZIONE] FORTUNA PER UN GIRO DI BIRRE
	class Npc135 extends Npc{
		private $npcId = 135;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){

$this->addTimesTalked();

$Ut = $this->getUtente();
$text = $this->getText();
$flag = $this->getFlag();

$keyboard1 = new Keyboard();
$keyboard1->push("Accetta");
$keyboard1->push("Rifiuta");

$Quadrifoglio = 126;
$prezzoQuadrifoglio = 20;
$carisma = $Ut->getTotalStat('CARISMA');
$prezzoQuadrifoglio -= intVal($carisma/10);

$prezzoQuadrifoglio = $prezzoQuadrifoglio < 10 ? 10 : $prezzoQuadrifoglio;

if($flag == 0){
write("<b>Fortuna Per Un Giro Di Birre</b>\n\nKmerr nota che curiosi attorno e richiama la tua attenzione.\n\nKmerr: È da giorni che mi sono aggirato per le foreste in cerca di un premio per la mia fama eccelsa e quello che mi son ritrovato è stato uno stupido quadrifoglio. Te lo vendo per qualche moneta ($prezzoQuadrifoglio), quel che basta per fare qualche altro giro di birra, che ne dici? ");
$this->setKeyFlagStatus($keyboard1, 1, 18);
}

if($flag == 1){

switch($text){


case 'Accetta':
if($Ut->togliSoldi($prezzoQuadrifoglio)){
	write("Paghi la cifra e il guerriero ti cede la rarità\n\n");
	$Ut->giveItem($Quadrifoglio);

	$Ut->initNotifyGiveItem();
	$Ut->notifyGiveItem($Quadrifoglio);
}
else{
	write("<b>Kmerr</b>: Non prendere in giro la mia immagine con offerte al limite dell'elemosina");
}
$this->backToMainMenu(0);
break;


case 'Rifiuta':
write("Preferisci non fare acquisti avventati. Kmerr ne è indifferente e torna a sedersi borbottando quanto vorrebbe stringere tra le mani una buona ambrata");
$this->backToMainMenu(0);
break;

default:
write("Scegli un opzione valida");
$this->setKeyFlagStatus($keyboard1, 1, 18);

}
}

	}
}