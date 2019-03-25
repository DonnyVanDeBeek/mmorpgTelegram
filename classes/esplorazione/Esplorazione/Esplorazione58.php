<?php
	Class Esplorazione58 extends Esplorazione{
		//Religione Di Fratellanza
		private $esplorazioneId = 58;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}