<?php
	Class Esplorazione22 extends Esplorazione{
		//Dono Del Vento
		private $esplorazioneId = 22;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}