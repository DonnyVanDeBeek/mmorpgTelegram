<?php
	Class Esplorazione55 extends Esplorazione{
		//Prega E Ti Sarà Dato
		private $esplorazioneId = 55;

		public function __construct(&$ut){
			$this->setUtente($ut);
			parent::__construct($this->esplorazioneId);
		}
	}