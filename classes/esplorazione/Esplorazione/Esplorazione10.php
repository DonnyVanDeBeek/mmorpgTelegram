<?php
	Class Esplorazione10 extends Esplorazione{
		//Viviamo Proprio In Una Società...
		private $esplorazioneId = 10;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}