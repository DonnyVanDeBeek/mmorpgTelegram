<?php
	Class Esplorazione63 extends Esplorazione{
		//Bottiglia D'Annata
		private $esplorazioneId = 63;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}