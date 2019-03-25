<?php
	Class Esplorazione34 extends Esplorazione{
		//Rapina A Mano (Quasi) Armata
		private $esplorazioneId = 34;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}