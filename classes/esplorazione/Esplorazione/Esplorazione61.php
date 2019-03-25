<?php
	Class Esplorazione61 extends Esplorazione{
		//Fortuna Per Un Giro Di Birre
		private $esplorazioneId = 61;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$npcId = 135;
			$this->redirectToNpc($npcId);
			return true;
		}
	}