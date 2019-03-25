<?php
	Class Esplorazione16 extends Esplorazione{
		//Spiazzo Muschioso
		private $esplorazioneId = 16;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}