<?php
	Class Esplorazione45 extends Esplorazione{
		//Scambio Sulla Montagna
		private $esplorazioneId = 45;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$StellaAlpina = 93;
			$Cipolla = 1;
			if($this->getUtente()->getNumTipoItem($Cipolla) < 10)
				return false;

			$npcId = 107;
			$this->redirectToNpc($npcId);
			return true;
		}
	}