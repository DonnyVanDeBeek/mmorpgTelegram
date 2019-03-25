<?php
	Class Esplorazione29 extends Esplorazione{
		//State Morbidi...
		private $esplorazioneId = 29;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}