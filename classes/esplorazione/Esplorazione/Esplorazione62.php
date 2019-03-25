<?php
	Class Esplorazione62 extends Esplorazione{
		//Pasto Bucolico
		private $esplorazioneId = 62;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}