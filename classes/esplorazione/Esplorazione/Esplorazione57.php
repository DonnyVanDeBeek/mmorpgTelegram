<?php
	Class Esplorazione57 extends Esplorazione{
		//Doni Propiziatori
		private $esplorazioneId = 57;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}