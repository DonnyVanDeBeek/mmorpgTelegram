<?php
	Class Esplorazione30 extends Esplorazione{
		//Ragazzini Affamati
		private $esplorazioneId = 30;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$this->redirectToNpc(103);
			return true;
		}
	}