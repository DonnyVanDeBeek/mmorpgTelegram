<?php
	Class Esplorazione3 extends Esplorazione{
		//Solidarietà tra ubriaconi
		private $esplorazioneId = 3;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}