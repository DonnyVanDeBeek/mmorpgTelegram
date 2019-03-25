<?php
	Class Esplorazione1 extends Esplorazione{
		private $esplorazioneId = 1;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}