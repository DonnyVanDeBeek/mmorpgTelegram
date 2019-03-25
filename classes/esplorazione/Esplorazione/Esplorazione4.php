<?php
	Class Esplorazione4 extends Esplorazione{
		//Onesto Contributore Del Fisco
		private $esplorazioneId = 4;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}