<?php
	Class Esplorazione26 extends Esplorazione{
		//L'Occhio Della Foresta
		private $esplorazioneId = 26;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}