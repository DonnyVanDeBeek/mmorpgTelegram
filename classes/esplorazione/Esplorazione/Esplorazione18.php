<?php
	Class Esplorazione18 extends Esplorazione{
		//Scampagnata Per I Boschi
		private $esplorazioneId = 18;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}