<?php
	Class Esplorazione28 extends Esplorazione{
		//Un Tenero Cagnolino
		private $esplorazioneId = 28;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$npcEvento = 102;
			$className = 'Npc'.$npcEvento;
			$Npc = new $className();
			$this->getUtente()->setUtenteNpcId($npcEvento);
			
			$Npc->setUtente($this->getUtente());
			$Npc->setFlag(0);
			$Npc->talk();

			global $key;
			$key = $Npc->getKeyboard();
			return true;
		}
	}