<?php
	//[NPC ESPLORAZIONE] SPETTACOLI DI STRADA
	class Npc136 extends Npc{
		private $npcId = 136;

		public function __construct(){
			parent::__construct($this->npcId);
		}

		public function talk(){

$this->addTimesTalked();

$Ut = $this->getUtente();
$text = $this->getText();
$flag = $this->getFlag();

$keyboard1 = new Keyboard();
$keyboard1->push("Dalle del denaro");
$keyboard1->push("Aspetti che finisca e provi ad avvicinarti per parlarle");
$keyboard1->push("Chiedi quanto costa la scimmia");
$keyboard1->push("Picchia la scimmia");

if($flag == 0){
write("Spettacoli Di Strada\n\nUna gitana si esibisce con una scimmietta davanti alla taverna, sopra una orchestrina di piatti e liuti in fondo alla via. Ti avvicini incantato dalle movenze e dal verde colore dei suoi occhi. ");
$this->setKeyFlagStatus($keyboard1, 1, 18);
}

if($flag == 1){

switch($text){


case 'Dalle del denaro':
$monete = 4;
if($Ut->togliSoldi($monete)){
	write("Ti avvicini e provi a ricompensare lo spettacolo avvicinando alla scimmietta delle monete, che lesta le prende e le fa sparire chissà dove. Per ringraziarti la ragazza ti dona un fiore.\n\n");

	$FioreDiBach = 127;
	$exp = rand(25, 50);

	$Items = array();
	$Items[] = array('ITEM_ID' => $FioreDiBach, 'ITEM_QUANTITA' => 1);

	$Ut->giveManyItems($Items, true);
	write('');
	$Ut->giveExp($exp, true);


	$this->backToMainMenu(0);
}else{
	write('Non hai abbastanza monete da darle!');
	$this->setKeyFlagStatus($keyboard1, 1, 18);
}
break;


case 'Aspetti che finisca e provi ad avvicinarti per parlarle':
	$soglia = 50;
	$Carisma = $Ut->getTotalStat('CARISMA');
	if($Carisma < 50){
		write("Tuttavia c'è troppa calca e la donna ha altro da fare. Provi a farle qualche lusinga ma pare più banale reverenza d'occasione che un parere profondo."); 
	}else{
		write("La intercetti e inizi con scioltezza a complimentarsi per la sua bravura. Riesci a cogliere l'interesse della donna che decide di farsi offrire una birra in cambio di compagnia. Il tempo vola e in quello che pare poco tempo si è fatto ormai tramonto. Lei deve lasciarti ringraziandoti per il piacevole incontro, tu invece porti nel tuo cuore una felicità ingenua e sincera. Ottieni: buff saggezza, intelligenza, carisma; fazzoletto rosso; exp");

		$val = 45;
		$turni = 5;
		$Ut->giveBuff('SAGGEZZA', $val, $turni);
		$Ut->giveBuff('INTELLIGENZA', $val, $turni);
		$Ut->giveBuff('CARISMA', $val, $turni);

		$FazzolettoRosso = 212;
		$Items = array();
		$Items[] = array('ITEM_ID' => $FazzolettoRosso, 'ITEM_QUANTITA' => 1);
		$Ut->giveManyItems($Items, true);

		$exp = rand(25, 50);
		$Ut->giveExp($exp, true);
	}
	$this->backToMainMenu(0);
break;


case 'Chiedi quanto costa la scimmia':
	write("Chiedi quanto costi la bestiola alla ragazza intenta a far piroette. Perplessa ti risponde che non ha prezzo in quanto non è un oggetto ma un parente più che una bestia per lei. Te ne vai via insoddisfatto, volevi solo la scimmietta, non la storia della sua vita!");
	$Ut->giveBuff('CARISMA', -30, 5);
$this->backToMainMenu(0);
break;


case 'Picchia la scimmia':
	write("Tiri un cazzotto sul muso del primate lasciando tutti sconvolti. Devi fuggire via prima di essere linciato sia dalla folla che dalla ballerina, e in effetti la scimmia pare riprendersi abbastanza seccata (e ben si sa come sono le scimmie...). Allontanandoti una figura ti afferra per la manica e ti fa \"amico, avrei sempre voluto farlo io: sei un grande! Tieni, ti meriti questo\"");
	$Ut->giveBuff('CARISMA', -100, 5);

	$AsciaUlulante = 84;
	$Ut->giveEquip($AsciaUlulante);
	write("\n\nHai ottenuto Ascia Ululante!");
$this->backToMainMenu(0);
break;

default:
write("Scegli un opzione valida");
$this->setKeyFlagStatus($keyboard1, 1, 18);

}
}

}
	}