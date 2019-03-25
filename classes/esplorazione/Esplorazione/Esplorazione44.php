<?php
	Class Esplorazione44 extends Esplorazione{
		//Questione Di Funghi
		private $esplorazioneId = 44;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$npcId = 106;
			$this->redirectToNpc($npcId);
			return true;
		}
	}