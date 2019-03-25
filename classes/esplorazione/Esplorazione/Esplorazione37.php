<?php
	Class Esplorazione37 extends Esplorazione{
		//Leather Kids!
		private $esplorazioneId = 37;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}