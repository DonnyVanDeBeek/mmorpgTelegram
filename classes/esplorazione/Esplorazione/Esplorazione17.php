<?php
	Class Esplorazione17 extends Esplorazione{
		//Scampagnata Per I Boschi
		private $esplorazioneId = 17;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}