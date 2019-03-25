<?php
	Class Esplorazione51 extends Esplorazione{
		//Tuffo Temporale
		private $esplorazioneId = 51;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}