<?php
	Class Esplorazione68 extends Esplorazione{
		//Ueue di prova
		private $esplorazioneId = 68;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}