<?php
	Class Esplorazione31 extends Esplorazione{
		//Il Vecchio E Il Pozzo
		private $esplorazioneId = 31;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}