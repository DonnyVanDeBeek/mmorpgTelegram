<?php
	//STREGONE KRAGNO
	class Npc137 extends Npc{
		private $npcId = 137;

		public function __construct(){
			parent::__construct($this->npcId);
		}
		
		/*
		public function talk(){

$this->addTimesTalked();

$Ut = $this->getUtente();
$text = $this->getText();
$flag = $this->getFlag();

$keyboard1 = new Keyboard();
$keyboard1->push("Non so di cosa lei stia parlando, mi dispiace");
$keyboard1->push("Non ho nulla da darti, stupido vecchio!");
$keyboard1->push("Gemma della visione? Ne voglio sapere di più");

$keyboard2 = new Keyboard();
$keyboard2->push("Dove posso reperire questa gemma?");
$keyboard2->push("Se dovessi mai trovarne una, mi ricorderò di te, vecchio stregone!");

if($flag == 0){
write("un vecchio barbuto con indosso un cappello a punta ti scruta con le sue cespugliose sopracciglia\n\"Salve, mi chiamo Kragno. Non è che avresti una gemma della visione da regalare a questo povero stregone la cui vista si affievolisce col passare degli anni?\" ");
$this->setKeyFlagStatus($keyboard1, 1, 18);
}

if($flag == 1){

switch($text){


case 'Non so di cosa lei stia parlando, mi dispiace':
write("Il vecchio stregone si rattristisce\n\n<b>Kragno</b>: Vorrà dire che chiederò al prossimo... buona fortuna!");
$this->backToMainMenu(0);
break;


case 'Non ho nulla da darti, stupido vecchio!':
write("Kragno ride sotto i baffi\n\n<b>Kragno</b>: Stupido? Forse. Vecchio? Mai stato. Ossequie");
$this->backToMainMenu(0);
break;


case 'Gemma della visione? Ne voglio sapere di più':
write("Lo stregone esibisce il suo miglior sorriso\n\n<b>Kragno</b>: Devi sapere che una gemma della vista è in grado di migliorare spropositatamente gli occhi di colui che ne fa uso. Ora, un povero vecchio mezzo cieco come me è in cerca di essa solamente per riacquistare i suoi dieci decimi. Tuttavia, è un oggetto molto richiesto in campo militare per ovvi motivi. È in grado di fornire a una persona normale la vista di un'acquila!");
$this->setKeyFlagStatus($keyboard2 , 2 , 18);
break;

default:
write("Scegli un opzione valida");
$this->setKeyFlagStatus($keyboard1, 1, 18);

}
}

if($flag == 2){

switch($text){


case 'Dove posso reperire questa gemma?':
write("<b>Kragno</b>: Non ne esistono molte, in realtà. Ciononostante, le mie ricerche mi hanno portato a questo bosco. Che mi venga un colpo, qui è nascosta da qualche parte la mia tanto agognata gemma!\n\nKragno sembra determinato a trovare la gemma");
$this->backToMainMenu(0);
break;


case 'Se dovessi mai trovarne una, mi ricorderò di te, vecchio stregone!':
write("Kragno sghignazza\n\n<b>Kragno</b>: Bugiardo!\n\nKragno contempla il bosco");
$this->backToMainMenu(0);
break;

default:
write("Scegli un opzione valida");
$this->setKeyFlagStatus($keyboard2, 2, 18);

}
}

}

**/

	public function talk(){
		$this->addTimesTalked();

		if(!$this->tryToGetXML())
			$this->speak();

	}

	public function custom_sono_abbastanza_intelligente_per_te(){
		$intelligenza = $this->getUtente()->getTotalStat('INTELLIGENZA');
		if($intelligenza <= 0) $intelligenza = 1;
		if($intelligenza > 50)
			write($this->getSpeakNome().' Sì!');
		else
			write($this->getSpeakNome().' No!');

		$this->backToMenu(0);
	}

	


	}