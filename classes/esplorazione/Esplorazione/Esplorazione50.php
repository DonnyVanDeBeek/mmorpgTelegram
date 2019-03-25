<?php
	Class Esplorazione50 extends Esplorazione{
		//Spruzzolo L'Incorreggibile
		private $esplorazioneId = 50;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}