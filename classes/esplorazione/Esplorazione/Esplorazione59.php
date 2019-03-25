<?php
	Class Esplorazione59 extends Esplorazione{
		//L'Empireo Sfuma In Polvere Di Stelle
		private $esplorazioneId = 59;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}