<?php
	Class Esplorazione43 extends Esplorazione{
		//La Spada Nel Carretto
		private $esplorazioneId = 43;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}