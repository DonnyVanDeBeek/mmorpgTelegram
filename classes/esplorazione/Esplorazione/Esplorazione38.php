<?php
	Class Esplorazione38 extends Esplorazione{
		//Breve Apnea
		private $esplorazioneId = 38;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}