<?php
	Class Esplorazione33 extends Esplorazione{
		//Nobile Destriero
		private $esplorazioneId = 33;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}