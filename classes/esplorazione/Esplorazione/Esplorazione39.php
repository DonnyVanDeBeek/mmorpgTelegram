<?php
	Class Esplorazione39 extends Esplorazione{
		//Lunga Apnea
		private $esplorazioneId = 39;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}