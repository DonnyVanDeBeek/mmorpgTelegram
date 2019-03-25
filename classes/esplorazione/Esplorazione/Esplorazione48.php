<?php
	Class Esplorazione48 extends Esplorazione{
		//Quel Che Ne Rimane
		private $esplorazioneId = 48;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}