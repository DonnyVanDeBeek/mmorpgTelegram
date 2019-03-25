<?php
	Class Esplorazione12 extends Esplorazione{
		//Anatema Sbiadito
		private $esplorazioneId = 12;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}