<?php
	Class Esplorazione42 extends Esplorazione{
		//La Spada Nel Carretto
		private $esplorazioneId = 42;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}