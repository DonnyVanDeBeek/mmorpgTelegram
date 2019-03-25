<?php
	Class Esplorazione41 extends Esplorazione{
		//Petali Di Sorgente
		private $esplorazioneId = 41;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}