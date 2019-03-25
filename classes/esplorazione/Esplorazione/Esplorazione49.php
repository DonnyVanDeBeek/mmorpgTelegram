<?php
	Class Esplorazione49 extends Esplorazione{
		//Coltello Vagante
		private $esplorazioneId = 49;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}