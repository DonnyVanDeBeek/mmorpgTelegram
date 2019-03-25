<?php
	Class Esplorazione2 extends Esplorazione{
		//Il Dahü 
		private $esplorazioneId = 2;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$npcEventoDahu = 101;
			$className = 'Npc'.$npcEventoDahu;
			$Npc = new $className();
			$this->getUtente()->setUtenteNpcId($npcEventoDahu);
			
			$Npc->setUtente($this->getUtente());
			$Npc->setFlag(0);
			$Npc->talk();

			global $key;
			$key = $Npc->getKeyboard();
			return true;
		}
	}