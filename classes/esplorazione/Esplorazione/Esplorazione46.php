<?php
	Class Esplorazione46 extends Esplorazione{
		//Incontro Inaspettato
		private $esplorazioneId = 46;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}