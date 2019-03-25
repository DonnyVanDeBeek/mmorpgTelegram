<?php
	Class Esplorazione9 extends Esplorazione{
		//Happy Hour
		private $esplorazioneId = 9;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}