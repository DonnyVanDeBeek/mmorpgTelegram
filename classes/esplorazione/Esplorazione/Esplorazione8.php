<?php
	Class Esplorazione8 extends Esplorazione{
		//Raccolto Di Luna Piena
		private $esplorazioneId = 8;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}