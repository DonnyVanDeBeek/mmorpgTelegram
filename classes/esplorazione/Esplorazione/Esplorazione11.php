<?php
	Class Esplorazione11 extends Esplorazione{
		//Anatema Sbiadito
		private $esplorazioneId = 11;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}