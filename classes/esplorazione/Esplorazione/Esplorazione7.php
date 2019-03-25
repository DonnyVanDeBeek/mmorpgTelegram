<?php
	Class Esplorazione7 extends Esplorazione{
		//Stridii Molesti
		private $esplorazioneId = 7;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}