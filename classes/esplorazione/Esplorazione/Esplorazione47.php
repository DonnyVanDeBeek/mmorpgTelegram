<?php
	Class Esplorazione47 extends Esplorazione{
		//Campanule In Abbondanza!
		private $esplorazioneId = 47;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}