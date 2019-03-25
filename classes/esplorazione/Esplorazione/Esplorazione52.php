<?php
	Class Esplorazione52 extends Esplorazione{
		//Zucca
		private $esplorazioneId = 52;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}

		public function start(){
			$this->redirectToNpc(108);
			return true;
		}
	}