<?php
	Class Esplorazione69 extends Esplorazione{
		//Muschio
		private $esplorazioneId = 69;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}