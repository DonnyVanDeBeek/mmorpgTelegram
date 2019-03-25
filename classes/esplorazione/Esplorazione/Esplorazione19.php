<?php
	Class Esplorazione19 extends Esplorazione{
		//Qualcuno Si Appese Sul Nido Del Cuculo
		private $esplorazioneId = 19;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}