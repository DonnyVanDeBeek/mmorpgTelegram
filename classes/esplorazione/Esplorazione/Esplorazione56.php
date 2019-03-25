<?php
	Class Esplorazione56 extends Esplorazione{
		//Decisamente Non Una Trappola
		private $esplorazioneId = 56;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}