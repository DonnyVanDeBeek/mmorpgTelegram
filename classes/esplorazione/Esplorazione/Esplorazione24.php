<?php
	Class Esplorazione24 extends Esplorazione{
		//Saranno più utili a me... 
		private $esplorazioneId = 24;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}