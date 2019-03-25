<?php
	Class Esplorazione27 extends Esplorazione{
		//Indovinello
		private $esplorazioneId = 27;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}