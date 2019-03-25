<?php
	Class Esplorazione23 extends Esplorazione{
		//Missiva Urgente
		private $esplorazioneId = 23;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}