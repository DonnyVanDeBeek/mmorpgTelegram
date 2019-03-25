<?php
	Class Esplorazione60 extends Esplorazione{
		//Spettacoli Di Strada
		private $esplorazioneId = 60;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$npcId = 136;
			$this->redirectToNpc($npcId);
			return true;
		}
	}